<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBusRequest;
use App\Http\Requests\Admin\UpdateBusRequest;
use App\Models\Bus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminBusController extends Controller
{
    public function index(): View
    {
        $buses = Bus::withCount('schedules')->latest()->paginate(10);
        return view('admin.buses.index', compact('buses'));
    }

    public function create(): View
    {
        return view('admin.buses.create');
    }

    public function store(StoreBusRequest $request): RedirectResponse
    {
        Bus::create($request->validated());

        return redirect()
            ->route('admin.buses.index')
            ->with('success', 'Bus berhasil ditambahkan.');
    }

    public function edit(Bus $bus): View
    {
        return view('admin.buses.edit', compact('bus'));
    }

    public function update(UpdateBusRequest $request, Bus $bus): RedirectResponse
    {
        $bus->update($request->validated());

        return redirect()
            ->route('admin.buses.index')
            ->with('success', 'Bus berhasil diperbarui.');
    }

    public function destroy(Bus $bus): RedirectResponse
    {
        // Cek apakah bus masih punya jadwal aktif
        $hasActiveSchedule = $bus->schedules()->where('status', 'active')->exists();

        if ($hasActiveSchedule) {
            return back()->with('error', 'Bus tidak dapat dihapus karena masih memiliki jadwal aktif.');
        }

        $bus->delete();

        return redirect()
            ->route('admin.buses.index')
            ->with('success', 'Bus berhasil dihapus.');
    }
}
