<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Riwayat Pesanan</title></head>
<body>
    <h2>Riwayat Pesanan</h2>

    @forelse($orders as $order)
        <div style="border:1px solid #ccc; padding:12px; margin:8px 0;">
            <strong>{{ $order->order_code }}</strong><br>
            {{ $order->schedule->route->origin }} → {{ $order->schedule->route->destination }}<br>
            Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}<br>
            Status Order: {{ $order->status }}<br>
            Status Bayar: {{ $order->payment->status }}<br>
            <a href="{{ route('orders.show', $order) }}">Lihat Detail</a>
        </div>
    @empty
        <p>Belum ada pesanan.</p>
    @endforelse

    {{ $orders->links() }}

    <a href="{{ route('schedules.index') }}">Cari Jadwal</a>
</body>
</html>
