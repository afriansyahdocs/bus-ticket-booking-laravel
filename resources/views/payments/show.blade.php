<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Konfirmasi Pembayaran</title></head>
<body>
    <h2>Konfirmasi Pembayaran</h2>

    <h3>Ringkasan Pesanan</h3>
    <p>Kode Pesanan: <strong>{{ $order->order_code }}</strong></p>
    <p>Rute: {{ $order->schedule->route->origin }} → {{ $order->schedule->route->destination }}</p>
    <p>Bus: {{ $order->schedule->bus->name }} ({{ $order->schedule->bus->bus_class }})</p>
    <p>Berangkat: {{ $order->schedule->departure_time->format('d M Y, H:i') }}</p>

    <h3>Data Penumpang</h3>
    @foreach($order->passengers as $passenger)
        <div style="border:1px solid #ccc; padding:8px; margin:4px 0;">
            Nama: {{ $passenger->passenger_name }} |
            NIK: {{ $passenger->id_number }} |
            Kursi: {{ $passenger->seat_number }}
        </div>
    @endforeach

    <h3>Total Pembayaran</h3>
    <p style="font-size:1.2em">
        <strong>Rp {{ number_format($order->payment->amount, 0, ',', '.') }}</strong>
    </p>
    <p>Kode Pembayaran: {{ $order->payment->payment_code }}</p>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('payment.confirm', $order) }}">
        @csrf
        <label>Pilih Metode Pembayaran:</label><br><br>

        <label>
            <input type="radio" name="payment_method" value="transfer" required>
            Transfer Bank
        </label><br>

        <label>
            <input type="radio" name="payment_method" value="ewallet">
            E-Wallet
        </label><br>

        <label>
            <input type="radio" name="payment_method" value="cash">
            Cash
        </label><br><br>

        <button type="submit">Konfirmasi Pembayaran</button>
        <a href="{{ route('orders.show', $order) }}">Kembali</a>
    </form>
</body>
</html>
