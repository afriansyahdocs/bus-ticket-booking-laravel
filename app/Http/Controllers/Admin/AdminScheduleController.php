<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreScheduleRequest;
use App\Http\Requests\Admin\UpdateScheduleRequest;
use App\Models\Bus;
use App\Models\Route;
use App\Models\Schedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminScheduleController extends Controller
{
    public function index(): View
    {
        $schedules = Schedule::with(['bus', 'route'])
            ->withCount('orders')
            ->latest()
            ->paginate(10);

        return view('admin.schedules.index', compact('schedules'));
    }

    public function create(): View
    {
        $buses  = Bus::all();
        $routes = Route::all();
        return view('admin.schedules.create', compact('buses', 'routes'));
    }

    public function store(StoreScheduleRequest $request): RedirectResponse
    {
        $bus  = Bus::findOrFail($request->bus_id);
        $data = $request->validated();
        $data['available_seats'] = $bus->total_seats;

        Schedule::create($data);

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Schedule $schedule): View
    {
        $buses  = Bus::all();
        $routes = Route::all();
        return view('admin.schedules.edit', compact('schedule', 'buses', 'routes'));
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule): RedirectResponse
    {
        $schedule->update($request->validated());

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule): RedirectResponse
    {
        $hasOrder = $schedule->orders()->whereIn('status', ['pending', 'confirmed'])->exists();

        if ($hasOrder) {
            return back()->with('error', 'Jadwal tidak dapat dihapus karena masih ada pesanan aktif.');
        }

        $schedule->delete();

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}
