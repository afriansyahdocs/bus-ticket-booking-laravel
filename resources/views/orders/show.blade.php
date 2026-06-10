@extends('layouts.app')
@section('title', 'Detail Pesanan')
@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h2>Detail Pesanan</h2>
            <span class="badge badge-{{ $order->status }}" style="font-size:13px; padding:6px 12px;">{{ $order->status }}</span>
        </div>

        <table style="width:auto; margin-bottom:20px;">
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Kode Pesanan</td><td><strong>{{ $order->order_code }}</strong></td></tr>
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Rute</td><td>{{ $order->schedule->route->origin }} → {{ $order->schedule->route->destination }}</td></tr>
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Bus</td><td>{{ $order->schedule->bus->name }} ({{ ucfirst($order->schedule->bus->bus_class) }})</td></tr>
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
        <table style="width:auto; margin-bottom:16px;">
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Kode Bayar</td><td>{{ $order->payment->payment_code }}</td></tr>
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Total</td><td><strong>Rp {{ number_format($order->payment->amount, 0, ',', '.') }}</strong></td></tr>
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Status</td><td><span class="badge badge-{{ $order->payment->status }}">{{ $order->payment->status }}</span></td></tr>
            @if($order->payment->status === 'paid')
                <tr><td style="padding:6px 24px 6px 0; color:#888;">Metode</td><td>{{ ucfirst($order->payment->payment_method) }}</td></tr>
                <tr><td style="padding:6px 24px 6px 0; color:#888;">Dibayar</td><td>{{ $order->payment->paid_at->format('d M Y, H:i') }}</td></tr>
            @endif
        </table>

        {{-- Tombol aksi --}}
        <div style="display:flex; gap:8px; flex-wrap:wrap;">
            @if($order->status === 'pending' && $order->payment->status === 'pending')
                <a href="{{ route('payment.show', $order) }}" class="btn btn-success">Bayar Sekarang</a>
            @endif

            @if($order->status === 'confirmed')
                <a href="{{ route('orders.print', $order) }}" class="btn btn-primary">Download Tiket PDF</a>
            @endif

            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

        {{-- Form Batalkan --}}
        @if($order->status === 'pending')
            <div style="margin-top:24px; border-top:1px solid #eee; padding-top:20px;">
                <h3 style="margin-bottom:12px; color:#dc3545;">Batalkan Pesanan</h3>
                <form method="POST" action="{{ route('orders.cancel', $order) }}"
                      onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                    @csrf
                    @method('DELETE')
                    <div class="form-group" style="max-width:400px;">
                        <label>Alasan Pembatalan (opsional)</label>
                        <textarea name="reason" rows="3" placeholder="Tulis alasan pembatalan...">{{ old('reason') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                </form>
            </div>
        @elseif($order->status === 'cancelled')
            <div style="margin-top:20px; padding:12px 16px; background:#f8d7da; border-radius:6px; color:#721c24;">
                ✗ Dibatalkan pada {{ $order->cancelled_at->format('d M Y, H:i') }}
                @if($order->cancellation_reason)
                    <br>Alasan: {{ $order->cancellation_reason }}
                @endif
            </div>
        @endif
    </div>
@endsection
