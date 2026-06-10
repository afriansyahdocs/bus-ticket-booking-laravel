@extends('layouts.app')
@section('title', 'Konfirmasi Pembayaran')
@section('content')
    <div class="card">
        <h2 style="margin-bottom:20px;">Konfirmasi Pembayaran</h2>

        <h3 style="margin-bottom:10px;">Ringkasan Pesanan</h3>
        <table style="width:auto; margin-bottom:20px;">
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Kode Pesanan</td><td><strong>{{ $order->order_code }}</strong></td></tr>
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Rute</td><td>{{ $order->schedule->route->origin }} → {{ $order->schedule->route->destination }}</td></tr>
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Bus</td><td>{{ $order->schedule->bus->name }} ({{ ucfirst($order->schedule->bus->bus_class) }})</td></tr>
            <tr><td style="padding:6px 24px 6px 0; color:#888;">Berangkat</td><td>{{ $order->schedule->departure_time->format('d M Y, H:i') }}</td></tr>
        </table>

        <h3 style="margin-bottom:10px;">Data Penumpang</h3>
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

        <div style="background:#f8f9fa; border-radius:6px; padding:16px; margin-bottom:20px;">
            <div style="font-size:13px; color:#888;">Total Pembayaran</div>
            <div style="font-size:24px; font-weight:bold; color:#1a1a2e;">
                Rp {{ number_format($order->payment->amount, 0, ',', '.') }}
            </div>
            <div style="font-size:12px; color:#888; margin-top:4px;">Kode: {{ $order->payment->payment_code }}</div>
        </div>

        <form method="POST" action="{{ route('payment.confirm', $order) }}">
            @csrf
            <div class="form-group">
                <label style="margin-bottom:10px; display:block;">Pilih Metode Pembayaran</label>
                <label style="display:block; margin-bottom:8px;">
                    <input type="radio" name="payment_method" value="transfer" required> Transfer Bank
                </label>
                <label style="display:block; margin-bottom:8px;">
                    <input type="radio" name="payment_method" value="ewallet"> E-Wallet
                </label>
                <label style="display:block; margin-bottom:8px;">
                    <input type="radio" name="payment_method" value="cash"> Cash
                </label>
            </div>

            <div style="margin-top:20px;">
                <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
                <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary" style="margin-left:8px;">Kembali</a>
            </div>
        </form>
    </div>
@endsection
