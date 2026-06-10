@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <small class="text-uppercase text-muted fw-semibold">
                        Detail Pesanan
                    </small>
                    <h3 class="fw-bold mb-1 mt-1">
                        {{ $order->order_code }}
                    </h3>
                    <div class="text-muted">
                        {{ $order->schedule->route->origin }}
                        →
                        {{ $order->schedule->route->destination }}
                        <span class="mx-2">•</span>
                        {{ $order->schedule->departure_time->format('d M Y, H:i') }}
                    </div>
                </div>
                <div>
                    @switch($order->status)
                        @case('pending')
                            <span class="badge rounded-pill text-bg-warning fs-6 px-4 py-2">
                                Menunggu
                            </span>
                            @break
                        @case('confirmed')
                            <span class="badge rounded-pill text-bg-success fs-6 px-4 py-2">
                                Terkonfirmasi
                            </span>
                            @break
                        @case('cancelled')
                            <span class="badge rounded-pill text-bg-danger fs-6 px-4 py-2">
                                Dibatalkan
                            </span>
                            @break
                        @default
                            <span class="badge rounded-pill text-bg-secondary fs-6 px-4 py-2">
                                {{ ucfirst($order->status) }}
                            </span>
                    @endswitch
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Kiri --}}
        <div class="col-lg-8">
            {{-- Informasi Perjalanan --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">
                            Informasi Perjalanan
                        </h5>
                        <span class="badge text-bg-light border text-dark px-3 py-2">
                            {{ $order->schedule->bus->name }}
                        </span>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <small class="text-muted d-block mb-1">
                                Rute
                            </small>
                            <div class="fw-semibold fs-5">
                                {{ $order->schedule->route->origin }}
                                →
                                {{ $order->schedule->route->destination }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block mb-1">
                                Kelas Bus
                            </small>
                            <div class="fw-semibold">
                                {{ ucfirst($order->schedule->bus->bus_class) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block mb-1">
                                Waktu Berangkat
                            </small>
                            <div class="fw-semibold">
                                {{ $order->schedule->departure_time->format('d M Y') }}
                            </div>
                            <small class="text-muted">
                                {{ $order->schedule->departure_time->format('H:i') }}
                            </small>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block mb-1">
                                Total Penumpang
                            </small>
                            <div class="fw-semibold">
                                {{ $order->total_passengers }} Orang
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Penumpang --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        Data Penumpang
                    </h5>
                    <div class="row g-3">
                        @foreach($order->passengers as $passenger)
                            <div class="col-md-6">
                                <div class="border rounded-4 p-3 h-100">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <div class="fw-bold">
                                                {{ $passenger->passenger_name }}
                                            </div>
                                            <small class="text-muted">
                                                {{ $passenger->id_number }}
                                            </small>
                                        </div>
                                        <span class="badge rounded-pill text-bg-primary px-3 py-2">
                                            Kursi {{ $passenger->seat_number }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Pembayaran --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">
                            Informasi Pembayaran
                        </h5>
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
                        @endswitch
                    </div>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <small class="text-muted d-block mb-1">
                                Kode Pembayaran
                            </small>
                            <div class="fw-semibold">
                                {{ $order->payment->payment_code }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block mb-1">
                                Total Pembayaran
                            </small>
                            <div class="fw-bold text-primary">
                                Rp {{ number_format($order->payment->amount, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block mb-1">
                                Metode Pembayaran
                            </small>
                            <div class="fw-semibold">
                                {{ ucfirst($order->payment->payment_method ?? '-') }}
                            </div>
                        </div>
                    </div>
                    @if($order->payment->status === 'paid')
                        <hr class="my-4">
                        <small class="text-muted d-block mb-1">
                            Waktu Pembayaran
                        </small>
                        <div class="fw-semibold">
                            {{ $order->payment->paid_at->format('d M Y, H:i') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Kanan --}}
        <div class="col-lg-4">
            {{-- Ringkasan --}}
            <div class="card border-0 shadow-sm mb-4 sticky-top"
                 style="top: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        Ringkasan Pesanan
                    </h5>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">
                            Total Penumpang
                        </span>
                        <span class="fw-semibold">
                            {{ $order->total_passengers }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">
                            Harga per Tiket
                        </span>
                        <span class="fw-semibold">
                            Rp {{ number_format($order->schedule->price, 0, ',', '.') }}
                        </span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">
                            Total
                        </span>
                        <h4 class="fw-bold text-primary mb-0">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </h4>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        @if($order->status === 'pending' && $order->payment->status === 'pending')
                            <a href="{{ route('payment.show', $order) }}"
                               class="btn btn-success">
                                Bayar Sekarang
                            </a>
                        @endif
                        <a href="{{ route('orders.index') }}"
                           class="btn btn-outline-secondary">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            {{-- Pembatalan --}}
            @if($order->status === 'pending')
                <div class="card border-danger shadow-sm">
                    <div class="card-header bg-danger text-white fw-semibold">
                        Batalkan Pesanan
                    </div>
                    <div class="card-body">
                        <form method="POST"
                              action="{{ route('orders.cancel', $order) }}"
                              onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                            @csrf
                            @method('DELETE')
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Alasan Pembatalan
                                </label>
                                <textarea class="form-control" name="reason" rows="3" placeholder="Tulis alasan pembatalan...">{{ old('reason') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-danger w-100">
                                Batalkan Pesanan
                            </button>
                        </form>
                    </div>
                </div>
            @elseif($order->status === 'cancelled')
                <div class="alert alert-danger border-0 shadow-sm">
                    <h6 class="fw-bold mb-2">
                        Pesanan Dibatalkan
                    </h6>
                    <div class="small">
                        {{ $order->cancelled_at->format('d M Y, H:i') }}
                    </div>
                    @if($order->cancellation_reason)
                        <hr>
                        <div>
                            <strong>Alasan:</strong>
                            <div class="mt-1">
                                {{ $order->cancellation_reason }}
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
