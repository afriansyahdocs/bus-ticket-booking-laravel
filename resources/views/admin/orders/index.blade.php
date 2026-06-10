@extends('layouts.admin')
@section('title', 'Kelola Pesanan')
@section('content')

<div class="mb-4">
    <h4 class="fw-bold mb-1">
        Kelola Pesanan
    </h4>
    <p class="text-muted mb-0">
        Daftar seluruh transaksi pemesanan tiket bus.
    </p>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>User</th>
                        <th>Rute</th>
                        <th>Total</th>
                        <th>Status Order</th>
                        <th>Status Bayar</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <span class="fw-semibold">
                                    {{ $order->order_code }}
                                </span>
                            </td>
                            <td>
                                {{ $order->user->name }}
                            </td>
                            <td>
                                {{ $order->schedule->route->origin }}
                                →
                                {{ $order->schedule->route->destination }}
                            </td>
                            <td class="fw-semibold text-primary">
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
                                @else
                                    <span class="badge bg-secondary">
                                        {{ ucfirst($order->payment->status) }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye me-1"></i>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"
                                class="text-center text-muted py-4">
                                Belum ada pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $orders->links() }}
        </div>
    </div>
</div>

@endsection
