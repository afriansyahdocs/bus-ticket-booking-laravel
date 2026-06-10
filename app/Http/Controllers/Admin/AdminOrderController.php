<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with(['user', 'schedule.route', 'payment'])
            ->latest()
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'schedule.route', 'schedule.bus', 'passengers', 'payment']);
        return view('admin.orders.show', compact('order'));
    }
}
