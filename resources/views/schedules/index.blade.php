<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Jadwal Bus</title></head>
<body>
    <h2>Cari Jadwal Bus</h2>

    <form method="GET" action="{{ route('schedules.index') }}">
        <input type="text" name="origin" placeholder="Kota asal" value="{{ request('origin') }}">
        <input type="text" name="destination" placeholder="Kota tujuan" value="{{ request('destination') }}">
        <input type="date" name="date" value="{{ request('date') }}">
        <button type="submit">Cari</button>
        <a href="{{ route('schedules.index') }}">Reset</a>
    </form>

    @forelse ($schedules as $schedule)
        <div style="border:1px solid #ccc; padding:12px; margin:8px 0;">
            <strong>{{ $schedule->route->origin }} → {{ $schedule->route->destination }}</strong><br>
            Bus: {{ $schedule->bus->name }} ({{ $schedule->bus->bus_class }})<br>
            Berangkat: {{ $schedule->departure_time->format('d M Y, H:i') }}<br>
            Harga: Rp {{ number_format($schedule->price, 0, ',', '.') }}<br>
            Sisa Kursi: {{ $schedule->available_seats }}<br>
            <a href="{{ route('schedules.show', $schedule) }}">Lihat Detail</a>
            <a href="{{ route('orders.create', $schedule) }}">Pesan Tiket</a>
        </div>
    @empty
        <p>Tidak ada jadwal tersedia.</p>
    @endforelse

    {{ $schedules->links() }}
</body>
</html>
