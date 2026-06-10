<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRouteRequest;
use App\Http\Requests\Admin\UpdateRouteRequest;
use App\Models\Route;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminRouteController extends Controller
{
    public function index(): View
    {
        $routes = Route::withCount('schedules')->latest()->paginate(10);
        return view('admin.routes.index', compact('routes'));
    }

    public function create(): View
    {
        return view('admin.routes.create');
    }

    public function store(StoreRouteRequest $request): RedirectResponse
    {
        Route::create($request->validated());

        return redirect()
            ->route('admin.routes.index')
            ->with('success', 'Rute berhasil ditambahkan.');
    }

    public function edit(Route $route): View
    {
        return view('admin.routes.edit', compact('route'));
    }

    public function update(UpdateRouteRequest $request, Route $route): RedirectResponse
    {
        $route->update($request->validated());

        return redirect()
            ->route('admin.routes.index')
            ->with('success', 'Rute berhasil diperbarui.');
    }

    public function destroy(Route $route): RedirectResponse
    {
        $hasActiveSchedule = $route->schedules()->where('status', 'active')->exists();

        if ($hasActiveSchedule) {
            return back()->with('error', 'Rute tidak dapat dihapus karena masih memiliki jadwal aktif.');
        }

        $route->delete();

        return redirect()
            ->route('admin.routes.index')
            ->with('success', 'Rute berhasil dihapus.');
    }
}
