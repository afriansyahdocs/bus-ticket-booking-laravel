<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\Order;
use App\Models\Route;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_users'     => User::where('role', 'user')->count(),
            'total_buses'     => Bus::count(),
            'total_routes'    => Route::count(),
            'total_schedules' => Schedule::count(),
            'total_orders'    => Order::count(),
            'pending_orders'  => Order::where('status', 'pending')->count(),
            'confirmed_orders'=> Order::where('status', 'confirmed')->count(),
            'cancelled_orders'=> Order::where('status', 'cancelled')->count(),
            'total_revenue'   => Order::where('status', 'confirmed')
                                    ->sum('total_price'),
        ];

        $recentOrders = Order::with(['user', 'schedule.route'])
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
