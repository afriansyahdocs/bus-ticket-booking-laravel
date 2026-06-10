@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    {{-- Header --}}
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Dashboard Admin</h4>
        <p class="text-muted mb-0">
            Ringkasan data Bus Ticket System.
        </p>
    </div>

    {{-- Statistik --}}
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">Total User</small>
                            <h3 class="fw-bold mb-0">
                                {{ $stats['total_users'] }}
                            </h3>
                        </div>
                        <i class="bi bi-people fs-1 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">Total Bus</small>
                            <h3 class="fw-bold mb-0">
                                {{ $stats['total_buses'] }}
                            </h3>
                        </div>
                        <i class="bi bi-bus-front fs-1 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">Total Jadwal</small>
                            <h3 class="fw-bold mb-0">
                                {{ $stats['total_schedules'] }}
                            </h3>
                        </div>
                        <i class="bi bi-calendar-event fs-1 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Pesanan Terkonfirmasi
                            </small>
                            <h3 class="fw-bold text-success mb-0">
                                {{ $stats['confirmed_orders'] }}
                            </h3>
                        </div>
                        <i class="bi bi-check-circle fs-1 text-success"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Menunggu Pembayaran
                            </small>
                            <h3 class="fw-bold text-warning mb-0">
                                {{ $stats['pending_orders'] }}
                            </h3>
                        </div>
                        <i class="bi bi-hourglass-split fs-1 text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Total Pendapatan
                            </small>
                            <h4 class="fw-bold text-primary mb-0">
                                Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
                            </h4>
                        </div>
                        <i class="bi bi-cash-stack fs-1 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pesanan Terbaru --}}
    <div class="card">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0 fw-semibold">
                Pesanan Terbaru
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>User</th>
                            <th>Rute</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                            <tr>
                                <td>
                                    <strong>
                                        {{ $order->order_code }}
                                    </strong>
                                </td>
                                <td>
                                    {{ $order->user->name }}
                                </td>
                                <td>
                                    {{ $order->schedule->route->origin }}
                                    →
                                    {{ $order->schedule->route->destination }}
                                </td>
                                <td>
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                                <td>
                                    @if($order->status == 'confirmed')
                                        <span class="badge bg-success">
                                            Confirmed
                                        </span>
                                    @elseif($order->status == 'pending')
                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger">
                                            Cancelled
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                       class="btn btn-primary btn-sm">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="text-center text-muted py-4">
                                    Belum ada pesanan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
