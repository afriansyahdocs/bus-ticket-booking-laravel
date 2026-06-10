<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Detail Jadwal</title></head>
<body>
    <h2>{{ $schedule->route->origin }} → {{ $schedule->route->destination }}</h2>
    <p>Bus: {{ $schedule->bus->name }} | Kelas: {{ $schedule->bus->bus_class }}</p>
    <p>Berangkat: {{ $schedule->departure_time->format('d M Y, H:i') }}</p>
    <p>Tiba: {{ $schedule->arrival_time->format('d M Y, H:i') }}</p>
    <p>Harga: Rp {{ number_format($schedule->price, 0, ',', '.') }}</p>
    <p>Sisa Kursi: {{ $schedule->available_seats }}</p>

    <h3>Kursi Sudah Dipesan</h3>
    @if(count($bookedSeats) > 0)
        <p>{{ implode(', ', $bookedSeats) }}</p>
    @else
        <p>Belum ada kursi dipesan.</p>
    @endif

    <a href="{{ route('orders.create', $schedule) }}">Pesan Tiket</a>
    <a href="{{ route('schedules.index') }}">Kembali</a>
</body>
</html>
