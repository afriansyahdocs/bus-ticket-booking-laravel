@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2 style="margin-bottom:20px">Selamat datang, {{ auth()->user()->name }}!</h2>

    {{-- Statistik --}}
    <div style="display:flex; gap:16px; margin-bottom:24px; flex-wrap:wrap;">
        <div class="card" style="flex:1; min-width:180px; text-align:center;">
            <div style="font-size:28px; font-weight:bold; color:#1a1a2e;">{{ $totalOrders }}</div>
            <div style="color:#888; margin-top:4px;">Total Pesanan</div>
        </div>
        <div class="card" style="flex:1; min-width:180px; text-align:center;">
            <div style="font-size:28px; font-weight:bold; color:#28a745;">{{ $confirmedOrders }}</div>
            <div style="color:#888; margin-top:4px;">Pesanan Terkonfirmasi</div>
        </div>
        <div class="card" style="flex:1; min-width:180px; text-align:center;">
            <div style="font-size:28px; font-weight:bold; color:#ffc107;">{{ $pendingOrders }}</div>
            <div style="color:#888; margin-top:4px;">Menunggu Pembayaran</div>
        </div>
    </div>

    {{-- Aksi Cepat --}}
    <div class="card" style="margin-bottom:24px;">
        <h3 style="margin-bottom:14px;">Aksi Cepat</h3>
        <a href="{{ route('schedules.index') }}" class="btn btn-primary">🔍 Cari Jadwal Bus</a>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary" style="margin-left:8px;">📋 Riwayat Pesanan</a>
    </div>

    {{-- Pesanan Terbaru --}}
    <div class="card">
        <h3 style="margin-bottom:14px;">Pesanan Terbaru</h3>

        @forelse($recentOrders as $order)
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Rute</th>
                        <th>Berangkat</th>
                        <th>Total</th>
                        <th>Status</th>
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
                        <td><a href="{{ route('orders.show', $order) }}" class="btn btn-primary" style="padding:4px 10px; font-size:12px;">Detail</a></td>
                    </tr>
                </tbody>
            </table>
        @empty
            <p style="color:#888;">Belum ada pesanan. <a href="{{ route('schedules.index') }}">Cari jadwal sekarang</a>.</p>
        @endforelse
    </div>
@endsection
