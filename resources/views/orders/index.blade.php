@extends('layouts.app')
@section('title', 'Riwayat Pesanan')
@section('content')
    <h2 style="margin-bottom:20px;">Riwayat Pesanan</h2>

    <div class="card">
        @forelse($orders as $order)
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Rute</th>
                        <th>Berangkat</th>
                        <th>Total</th>
                        <th>Status Order</th>
                        <th>Status Bayar</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->order_code }}</td>
                        <td>{{ $order->schedule->route->origin }} → {{ $order->schedule->route->destination }}</td>
                        <td>{{ $order->schedule->departure_time->format('d M Y') }}</td>
                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td><span class="badge badge-{{ $order->status }}">{{ $order->status }}</span></td>
                        <td><span class="badge badge-{{ $order->payment->status }}">{{ $order->payment->status }}</span></td>
                        <td><a href="{{ route('orders.show', $order) }}" class="btn btn-primary" style="padding:4px 10px; font-size:12px;">Detail</a></td>
                    </tr>
                </tbody>
            </table>
        @empty
            <p style="color:#888; text-align:center; padding:20px;">Belum ada pesanan. <a href="{{ route('schedules.index') }}">Cari jadwal sekarang</a>.</p>
        @endforelse
    </div>

    {{ $orders->links() }}
@endsection
