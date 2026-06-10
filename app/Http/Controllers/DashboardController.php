<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $userId = auth()->id();

        $totalOrders     = Order::where('user_id', $userId)->count();
        $confirmedOrders = Order::where('user_id', $userId)->where('status', 'confirmed')->count();
        $pendingOrders   = Order::where('user_id', $userId)->where('status', 'pending')->count();

        $recentOrders = Order::where('user_id', $userId)
            ->with(['schedule.route'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalOrders',
            'confirmedOrders',
            'pendingOrders',
            'recentOrders'
        ));
    }
}
