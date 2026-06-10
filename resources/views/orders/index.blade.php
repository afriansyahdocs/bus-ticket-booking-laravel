@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                Riwayat Pesanan
            </h2>
            <p class="text-muted mb-0">
                Lihat daftar dan status seluruh pesanan tiket Anda.
            </p>
        </div>
        <a href="{{ route('schedules.index') }}"
           class="btn btn-primary">
            Pesan Tiket Baru
        </a>
    </div>

    {{-- Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if($orders->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">Kode</th>
                                <th class="py-3">Rute</th>
                                <th class="py-3">Berangkat</th>
                                <th class="py-3">Total</th>
                                <th class="py-3">Status Order</th>
                                <th class="py-3">Status Bayar</th>
                                <th class="text-end px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    {{-- Kode --}}
                                    <td class="px-4">
                                        <div class="fw-semibold text-dark">
                                            {{ $order->order_code }}
                                        </div>
                                    </td>
                                    {{-- Rute --}}
                                    <td>
                                        <div class="fw-semibold">
                                            {{ $order->schedule->route->origin }}
                                            →
                                            {{ $order->schedule->route->destination }}
                                        </div>
                                        <small class="text-muted">
                                            {{ $order->schedule->bus->name ?? 'Bus' }}
                                        </small>
                                    </td>
                                    {{-- Berangkat --}}
                                    <td>
                                        <div class="fw-semibold">
                                            {{ $order->schedule->departure_time->format('d M Y') }}
                                        </div>
                                        <small class="text-muted">
                                            {{ $order->schedule->departure_time->format('H:i') }}
                                        </small>
                                    </td>
                                    {{-- Total --}}
                                    <td>
                                        <span class="fw-bold text-primary">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    {{-- Status Order --}}
                                    <td>
                                        @switch($order->status)
                                            @case('pending')
                                                <span class="badge rounded-pill text-bg-warning px-3 py-2">
                                                    Menunggu
                                                </span>
                                                @break
                                            @case('confirmed')
                                                <span class="badge rounded-pill text-bg-success px-3 py-2">
                                                    Dikonfirmasi
                                                </span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge rounded-pill text-bg-danger px-3 py-2">
                                                    Dibatalkan
                                                </span>
                                                @break
                                            @default
                                                <span class="badge rounded-pill text-bg-secondary px-3 py-2">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                        @endswitch
                                    </td>

                                    {{-- Status Pembayaran --}}
                                    <td>
                                        @switch($order->payment->status)
                                            @case('pending')
                                                <span class="badge rounded-pill text-bg-warning px-3 py-2">
                                                    Belum Bayar
                                                </span>
                                                @break
                                            @case('paid')
                                                <span class="badge rounded-pill text-bg-success px-3 py-2">
                                                    Lunas
                                                </span>
                                                @break
                                            @case('failed')
                                                <span class="badge rounded-pill text-bg-danger px-3 py-2">
                                                    Gagal
                                                </span>
                                                @break
                                            @default
                                                <span class="badge rounded-pill text-bg-secondary px-3 py-2">
                                                    {{ ucfirst($order->payment->status) }}
                                                </span>
                                        @endswitch
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="text-end px-4">
                                        <a href="{{ route('orders.show', $order) }}"
                                           class="btn btn-outline-primary btn-sm">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-5 px-3">
                    <div class="mb-3" style="font-size: 48px;">
                        🚌
                    </div>
                    <h5 class="fw-semibold text-dark mb-2">
                        Belum ada pesanan
                    </h5>
                    <p class="text-muted mb-4">
                        Anda belum melakukan pemesanan tiket bus.
                    </p>
                    <a href="{{ route('schedules.index') }}"
                       class="btn btn-primary">
                        Cari Jadwal Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>

    {{-- Pagination --}}
    @if($orders->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    @endif

</div>
@endsection
