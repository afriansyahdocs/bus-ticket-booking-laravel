@extends('layouts.admin')
@section('title', 'Detail Pesanan')
@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h2>Detail Pesanan</h2>
            <span class="badge badge-{{ $order->status }}" style="font-size:13px; padding:6px 12px;">{{ $order->status }}</span>
        </div>

        <table style="width:auto; margin-bottom:20px;">
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Kode Pesanan</td><td><strong>{{ $order->order_code }}</strong></td></tr>
            <tr><td style="padding:6px 24px 6px 0; color:#888;">User</td><td>{{ $order->user->name }} ({{ $order->user->email }})</td></tr>
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Rute</td><td>{{ $order->schedule->route->origin }} → {{ $order->schedule->route->destination }}</td></tr>
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Bus</td><td>{{ $order->schedule->bus->name }}</td></tr>
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Berangkat</td><td>{{ $order->schedule->departure_time->format('d M Y, H:i') }}</td></tr>
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Total Penumpang</td><td>{{ $order->total_passengers }} orang</td></tr>
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Total Harga</td><td><strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></td></tr>
        </table>

        <h3 style="margin-bottom:12px;">Data Penumpang</h3>
        <table style="margin-bottom:20px;">
            <thead>
                <tr><th>Nama</th><th>NIK</th><th>Kursi</th></tr>
            </thead>
            <tbody>
                @foreach($order->passengers as $passenger)
                    <tr>
                        <td>{{ $passenger->passenger_name }}</td>
                        <td>{{ $passenger->id_number }}</td>
                        <td>{{ $passenger->seat_number }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3 style="margin-bottom:12px;">Pembayaran</h3>
        <table style="width:auto;">
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Kode Bayar</td><td>{{ $order->payment->payment_code }}</td></tr>
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Total</td><td>Rp {{ number_format($order->payment->amount, 0, ',', '.') }}</td></tr>
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Metode</td><td>{{ $order->payment->payment_method ? ucfirst($order->payment->payment_method) : '-' }}</td></tr>
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Status</td><td><span class="badge badge-{{ $order->payment->status }}">{{ $order->payment->status }}</span></td></tr>
            @if($order->payment->paid_at)
                <tr><td style="padding:6px 24px 6px 0; color:#888;">Dibayar</td><td>{{ $order->payment->paid_at->format('d M Y, H:i') }}</td></tr>
            @endif
        </table>

        @if($order->status === 'cancelled' && $order->cancellation_reason)
            <div style="margin-top:16px; padding:12px 16px; background:#f8d7da; border-radius:6px; color:#721c24;">
                Alasan pembatalan: {{ $order->cancellation_reason }}
            </div>
        @endif

        <div style="margin-top:20px;">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
