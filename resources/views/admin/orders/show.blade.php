@extends('layouts.admin')
@section('title', 'Detail Pesanan')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">
            Detail Pesanan
        </h4>
        <p class="text-muted mb-0">
            Informasi lengkap transaksi.
        </p>
    </div>
    <div>
        @if($order->status == 'confirmed')
            <span class="badge bg-success fs-6">
                Confirmed
            </span>
        @elseif($order->status == 'pending')
            <span class="badge bg-warning text-dark fs-6">
                Pending
            </span>
        @elseif($order->status == 'cancelled')
            <span class="badge bg-danger fs-6">
                Cancelled
            </span>
        @endif
    </div>
</div>

{{-- Informasi Pesanan --}}
<div class="card mb-4">
    <div class="card-header bg-white">
        <h5 class="mb-0">
            Informasi Pesanan
        </h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <strong>Kode Pesanan</strong>
                <div>{{ $order->order_code }}</div>
            </div>
            <div class="col-md-6">
                <strong>User</strong>
                <div>
                    {{ $order->user->name }}
                    <br>
                    <small class="text-muted">
                        {{ $order->user->email }}
                    </small>
                </div>
            </div>
            <div class="col-md-6">
                <strong>Rute</strong>
                <div>
                    {{ $order->schedule->route->origin }}
                    →
                    {{ $order->schedule->route->destination }}
                </div>
            </div>
            <div class="col-md-6">
                <strong>Bus</strong>
                <div>
                    {{ $order->schedule->bus->name }}
                </div>
            </div>
            <div class="col-md-6">
                <strong>Waktu Berangkat</strong>
                <div>
                    {{ $order->schedule->departure_time->format('d M Y, H:i') }}
                </div>
            </div>
            <div class="col-md-6">
                <strong>Total Penumpang</strong>
                <div>
                    {{ $order->total_passengers }} Orang
                </div>
            </div>
            <div class="col-12">
                <strong>Total Harga</strong>
                <h4 class="text-primary fw-bold mt-1">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </h4>
            </div>
        </div>
    </div>
</div>

{{-- Data Penumpang --}}
<div class="card mb-4">
    <div class="card-header bg-white">
        <h5 class="mb-0">
            Data Penumpang
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Kursi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->passengers as $passenger)
                        <tr>
                            <td>
                                {{ $passenger->passenger_name }}
                            </td>
                            <td>
                                {{ $passenger->id_number }}
                            </td>
                            <td>
                                <span class="badge bg-primary">
                                    {{ $passenger->seat_number }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Pembayaran --}}
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">
            Informasi Pembayaran
        </h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <strong>Kode Pembayaran</strong>
                <div>{{ $order->payment->payment_code }}</div>
            </div>
            <div class="col-md-6">
                <strong>Metode Pembayaran</strong>
                <div>
                    {{ $order->payment->payment_method
                        ? ucfirst($order->payment->payment_method)
                        : '-' }}
                </div>
            </div>
            <div class="col-md-6">
                <strong>Total Bayar</strong>
                <div>
                    Rp {{ number_format($order->payment->amount, 0, ',', '.') }}
                </div>
            </div>
            <div class="col-md-6">
                <strong>Status Pembayaran</strong>
                <div>
                    @if($order->payment->status == 'paid')
                        <span class="badge bg-success">
                            Paid
                        </span>
                    @elseif($order->payment->status == 'pending')
                        <span class="badge bg-warning text-dark">
                            Pending
                        </span>
                    @elseif($order->payment->status == 'failed')
                        <span class="badge bg-danger">
                            Failed
                        </span>
                    @endif
                </div>
            </div>
            @if($order->payment->paid_at)
                <div class="col-md-6">
                    <strong>Tanggal Pembayaran</strong>
                    <div>
                        {{ $order->payment->paid_at->format('d M Y, H:i') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@if($order->status === 'cancelled' && $order->cancellation_reason)
    <div class="alert alert-danger mt-4">
        <strong>Alasan Pembatalan:</strong>
        <br>
        {{ $order->cancellation_reason }}
    </div>
@endif

<div class="mt-4">
    <a href="{{ route('admin.orders.index') }}"
       class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>
        Kembali
    </a>
</div>

@endsection
