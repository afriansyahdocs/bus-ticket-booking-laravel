<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Detail Pesanan</title></head>
<body>
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <h2>Detail Pesanan</h2>
    <p>Kode Pesanan: <strong>{{ $order->order_code }}</strong></p>
    <p>Rute: {{ $order->schedule->route->origin }} → {{ $order->schedule->route->destination }}</p>
    <p>Bus: {{ $order->schedule->bus->name }}</p>
    <p>Berangkat: {{ $order->schedule->departure_time->format('d M Y, H:i') }}</p>
    <p>Total Penumpang: {{ $order->total_passengers }}</p>
    <p>Total Harga: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
    <p>Status: {{ $order->status }}</p>

    <h3>Data Penumpang</h3>
    @foreach($order->passengers as $passenger)
        <div style="border:1px solid #ccc; padding:8px; margin:4px 0;">
            Nama: {{ $passenger->passenger_name }} |
            NIK: {{ $passenger->id_number }} |
            Kursi: {{ $passenger->seat_number }}
        </div>
    @endforeach

    <h3>Pembayaran</h3>
    <p>Kode Bayar: {{ $order->payment->payment_code }}</p>
    <p>Total: Rp {{ number_format($order->payment->amount, 0, ',', '.') }}</p>
    <p>Status: <strong>{{ $order->payment->status }}</strong></p>
    
    @if($order->status === 'pending' && $order->payment->status === 'pending')
    <a href="{{ route('payment.show', $order) }}">
        <button>Bayar Sekarang</button>
    </a>
    @elseif($order->payment->status === 'paid')
    <p style="color:green">✓ Pembayaran lunas pada {{ $order->payment->paid_at->format('d M Y, H:i') }}</p>
    <p>Metode: {{ $order->payment->payment_method }}</p>
    @endif

    @if($order->status === 'pending')
    <hr>
    <h3>Batalkan Pesanan</h3>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('orders.cancel', $order) }}"
          onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
        @csrf
        @method('DELETE')
        <div>
            <label>Alasan Pembatalan (opsional)</label><br>
            <textarea name="reason" rows="3" cols="40"
                placeholder="Tulis alasan pembatalan...">{{ old('reason') }}</textarea>
        </div>
        <br>
        <button type="submit" style="color:red">Batalkan Pesanan</button>
    </form>
    
    @elseif($order->status === 'cancelled')
    <hr>
    <p style="color:red">
        ✗ Pesanan dibatalkan pada {{ $order->cancelled_at->format('d M Y, H:i') }}
    </p>
    @if($order->cancellation_reason)
        <p>Alasan: {{ $order->cancellation_reason }}</p>
    @endif
    @endif

    <a href="{{ route('orders.index') }}">Riwayat Pesanan</a>
</body>
</html>
