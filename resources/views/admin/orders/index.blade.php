@extends('layouts.admin')
@section('title', 'Kelola Pesanan')
@section('content')
    <h2 style="margin-bottom:16px;">Kelola Pesanan</h2>
    <div class="card">
        <table>
            <thead>
                <tr><th>Kode</th><th>User</th><th>Rute</th><th>Total</th><th>Status Order</th><th>Status Bayar</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->order_code }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->schedule->route->origin }} → {{ $order->schedule->route->destination }}</td>
                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td><span class="badge badge-{{ $order->status }}">{{ $order->status }}</span></td>
                        <td><span class="badge badge-{{ $order->payment->status }}">{{ $order->payment->status }}</span></td>
                        <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary">Detail</a></td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align:center; color:#888;">Belum ada pesanan.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top:16px;">{{ $orders->links() }}</div>
    </div>
@endsection
