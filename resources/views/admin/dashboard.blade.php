@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

    <div style="display:flex; gap:14px; flex-wrap:wrap; margin-bottom:24px;">
        <div class="card" style="flex:1; min-width:140px; text-align:center;">
            <div style="font-size:26px; font-weight:bold; color:#1a1a2e;">{{ $stats['total_users'] }}</div>
            <div style="color:#888; font-size:13px; margin-top:4px;">Total User</div>
        </div>
        <div class="card" style="flex:1; min-width:140px; text-align:center;">
            <div style="font-size:26px; font-weight:bold; color:#1a1a2e;">{{ $stats['total_buses'] }}</div>
            <div style="color:#888; font-size:13px; margin-top:4px;">Total Bus</div>
        </div>
        <div class="card" style="flex:1; min-width:140px; text-align:center;">
            <div style="font-size:26px; font-weight:bold; color:#1a1a2e;">{{ $stats['total_schedules'] }}</div>
            <div style="color:#888; font-size:13px; margin-top:4px;">Total Jadwal</div>
        </div>
        <div class="card" style="flex:1; min-width:140px; text-align:center;">
            <div style="font-size:26px; font-weight:bold; color:#28a745;">{{ $stats['confirmed_orders'] }}</div>
            <div style="color:#888; font-size:13px; margin-top:4px;">Pesanan Terkonfirmasi</div>
        </div>
        <div class="card" style="flex:1; min-width:140px; text-align:center;">
            <div style="font-size:26px; font-weight:bold; color:#ffc107;">{{ $stats['pending_orders'] }}</div>
            <div style="color:#888; font-size:13px; margin-top:4px;">Menunggu Bayar</div>
        </div>
        <div class="card" style="flex:1; min-width:140px; text-align:center;">
            <div style="font-size:26px; font-weight:bold; color:#17a2b8;">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
            <div style="color:#888; font-size:13px; margin-top:4px;">Total Pendapatan</div>
        </div>
    </div>

    <div class="card">
        <h3 style="margin-bottom:14px;">Pesanan Terbaru</h3>
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>User</th>
                    <th>Rute</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                    <tr>
                        <td>{{ $order->order_code }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->schedule->route->origin }} → {{ $order->schedule->route->destination }}</td>
                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td><span class="badge badge-{{ $order->status }}">{{ $order->status }}</span></td>
                        <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary">Detail</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center; color:#888;">Belum ada pesanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
