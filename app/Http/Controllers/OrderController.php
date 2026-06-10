<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Schedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::where('user_id', auth()->id())
            ->with(['schedule.route', 'payment'])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create(Schedule $schedule): View
    {
        abort_if($schedule->status !== 'active', 403, 'Jadwal tidak tersedia.');
        abort_if($schedule->available_seats < 1, 403, 'Kursi sudah habis.');

        $schedule->load(['bus', 'route']);

        return view('orders.create', compact('schedule'));
    }

    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $schedule = Schedule::lockForUpdate()->findOrFail($request->schedule_id);

        // Cek sisa kursi mencukupi
        if ($schedule->available_seats < count($request->passengers)) {
            throw ValidationException::withMessages([
                'passengers' => 'Kursi tidak mencukupi. Sisa kursi: ' . $schedule->available_seats,
            ]);
        }

        // Cek kursi yang diminta sudah dipesan atau belum
        $requestedSeats = array_column($request->passengers, 'seat_number');

        $bookedSeats = $schedule->orders()
            ->whereIn('status', ['pending', 'confirmed'])
            ->with('passengers')
            ->get()
            ->pluck('passengers')
            ->flatten()
            ->pluck('seat_number')
            ->toArray();

        $conflictSeats = array_intersect($requestedSeats, $bookedSeats);

        if (!empty($conflictSeats)) {
            throw ValidationException::withMessages([
                'passengers' => 'Kursi ' . implode(', ', $conflictSeats) . ' sudah dipesan.',
            ]);
        }

        // Cek duplikat kursi dalam satu order
        if (count($requestedSeats) !== count(array_unique($requestedSeats))) {
            throw ValidationException::withMessages([
                'passengers' => 'Terdapat nomor kursi yang sama dalam satu pesanan.',
            ]);
        }

        // Proses simpan ke database
        $order = DB::transaction(function () use ($request, $schedule) {
            $totalPassengers = count($request->passengers);
            $totalPrice      = $schedule->price * $totalPassengers;

            // Buat order
            $order = Order::create([
                'user_id'          => auth()->id(),
                'schedule_id'      => $schedule->id,
                'order_code'       => $this->generateOrderCode(),
                'total_passengers' => $totalPassengers,
                'total_price'      => $totalPrice,
                'status'           => 'pending',
                'booked_at'        => now(),
            ]);

            // Buat data tiap penumpang
            foreach ($request->passengers as $passenger) {
                $order->passengers()->create([
                    'passenger_name' => $passenger['passenger_name'],
                    'id_number'      => $passenger['id_number'],
                    'seat_number'    => $passenger['seat_number'],
                ]);
            }

            // Buat record pembayaran
            $order->payment()->create([
                'payment_code' => $this->generatePaymentCode(),
                'amount'       => $totalPrice,
                'status'       => 'pending',
            ]);

            // Kurangi kursi tersedia
            $schedule->decrement('available_seats', $totalPassengers);

            return $order;
        });

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat! Kode: ' . $order->order_code);
    }

    public function show(Order $order): View
    {
        abort_if($order->user_id !== auth()->id(), 403);

        $order->load(['schedule.route', 'schedule.bus', 'passengers', 'payment']);

        return view('orders.show', compact('order'));
    }

    private function generateOrderCode(): string
    {
        do {
            $code = 'TKT-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
        } while (Order::where('order_code', $code)->exists());

        return $code;
    }

    private function generatePaymentCode(): string
    {
        do {
            $code = 'PAY-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
        } while (Payment::where('payment_code', $code)->exists());

        return $code;
    }
}
