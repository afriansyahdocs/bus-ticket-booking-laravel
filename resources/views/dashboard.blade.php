@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            Selamat datang, {{ auth()->user()->name }}!
        </h2>
        <p class="text-muted mb-0">
            Kelola perjalanan dan pantau status pemesanan Anda.
        </p>
    </div>


    {{-- Statistik --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h2 class="fw-bold text-primary mb-1">
                        {{ $totalOrders }}
                    </h2>
                    <p class="text-muted mb-0">
                        Total Pesanan
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h2 class="fw-bold text-success mb-1">
                        {{ $confirmedOrders }}
                    </h2>
                    <p class="text-muted mb-0">
                        Pesanan Terkonfirmasi
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h2 class="fw-bold text-warning mb-1">
                        {{ $pendingOrders }}
                    </h2>
                    <p class="text-muted mb-0">
                        Menunggu Pembayaran
                    </p>
                </div>
            </div>
        </div>
    </div>


    {{-- Aksi Cepat --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3">
                Aksi Cepat
            </h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('schedules.index') }}"
                   class="btn btn-primary">
                    Cari Jadwal Bus
                </a>
                <a href="{{ route('orders.index') }}"
                   class="btn btn-outline-secondary">
                    Riwayat Pesanan
                </a>
            </div>
        </div>
    </div>


    {{-- Pesanan Terbaru --}}
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-semibold mb-0">
                    Pesanan Terbaru
                </h5>
                @if($recentOrders->count())
                    <a href="{{ route('orders.index') }}"
                       class="btn btn-sm btn-outline-primary">
                        Lihat Semua
                    </a>
                @endif
            </div>

            @if($recentOrders->count())
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Rute</th>
                                <th>Berangkat</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td class="fw-semibold">
                                        {{ $order->order_code }}
                                    </td>
                                    <td>
                                        {{ $order->schedule->route->origin }}
                                        →
                                        {{ $order->schedule->route->destination }}
                                    </td>
                                    <td>
                                        {{ $order->schedule->departure_time->format('d M Y') }}
                                    </td>
                                    <td>
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        @if($order->status == 'pending')
                                            <span class="badge text-bg-warning">
                                                Pending
                                            </span>
                                        @elseif($order->status == 'confirmed')
                                            <span class="badge text-bg-success">
                                                Confirmed
                                            </span>
                                        @elseif($order->status == 'cancelled')
                                            <span class="badge text-bg-danger">
                                                Cancelled
                                            </span>
                                        @else
                                            <span class="badge text-bg-secondary">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-end">
                                        <a href="{{ route('orders.show', $order) }}"
                                           class="btn btn-sm btn-primary">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else

                <div class="text-center py-4">
                    <h6 class="text-muted">
                        Belum ada pesanan
                    </h6>
                    <p class="text-muted mb-3">
                        Mulai perjalanan Anda dengan memesan tiket bus.
                    </p>
                    <a href="{{ route('schedules.index') }}"
                       class="btn btn-primary">
                        Cari Jadwal Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>

@endsection
