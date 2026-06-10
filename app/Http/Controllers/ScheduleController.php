<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    public function index(Request $request): View
    {
        $query = Schedule::with(['bus', 'route'])
            ->where('status', 'active')
            ->where('available_seats', '>', 0);

        // Filter pencarian
        if ($request->filled('origin')) {
            $query->whereHas('route', function ($q) use ($request) {
                $q->where('origin', 'like', '%' . $request->origin . '%');
            });
        }

        if ($request->filled('destination')) {
            $query->whereHas('route', function ($q) use ($request) {
                $q->where('destination', 'like', '%' . $request->destination . '%');
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('departure_time', $request->date);
        }

        $schedules = $query->orderBy('departure_time')->paginate(10);

        return view('schedules.index', compact('schedules'));
    }

    public function show(Schedule $schedule): View
    {
        $schedule->load(['bus', 'route']);

        // Kursi yang sudah dipesan pada jadwal ini
        $bookedSeats = $schedule->orders()
            ->whereIn('status', ['pending', 'confirmed'])
            ->with('passengers')
            ->get()
            ->pluck('passengers')
            ->flatten()
            ->pluck('seat_number')
            ->toArray();

        return view('schedules.show', compact('schedule', 'bookedSeats'));
    }
}
