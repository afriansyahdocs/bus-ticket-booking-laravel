<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\ConfirmPaymentRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function show(Order $order): View
    {
        // Pastikan hanya pemilik order yang bisa akses
        abort_if($order->user_id !== auth()->id(), 403);

        // Pastikan order masih pending
        abort_if($order->status !== 'pending', 403, 'Pesanan ini sudah diproses.');

        $order->load(['schedule.route', 'schedule.bus', 'passengers', 'payment']);

        return view('payments.show', compact('order'));
    }

    public function confirm(ConfirmPaymentRequest $request, Order $order): RedirectResponse
    {
        // Pastikan hanya pemilik order yang bisa konfirmasi
        abort_if($order->user_id !== auth()->id(), 403);

        // Pastikan order masih pending
        abort_if($order->status !== 'pending', 403, 'Pesanan ini sudah diproses.');

        // Pastikan payment masih pending
        abort_if($order->payment->status !== 'pending', 403, 'Pembayaran sudah diproses.');

        DB::transaction(function () use ($request, $order) {
            // Update status payment
            $order->payment()->update([
                'payment_method' => $request->payment_method,
                'status'         => 'paid',
                'paid_at'        => now(),
            ]);

            // Update status order
            $order->update([
                'status' => 'confirmed',
            ]);
        });

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}
