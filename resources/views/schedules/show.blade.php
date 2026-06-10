@extends('layouts.app')
@section('title', 'Detail Jadwal')
@section('content')
    <div class="card">
        <h2 style="margin-bottom:16px;">{{ $schedule->route->origin }} → {{ $schedule->route->destination }}</h2>
        <table style="width:auto;">
            <tr><td style="padding:6px 16px 6px 0; color:#888;">Bus</td><td><strong>{{ $schedule->bus->name }}</strong></td></tr>
            <tr><td style="padding:6px 16px 6px 0; color:#888;">Kelas</td><td>{{ ucfirst($schedule->bus->bus_class) }}</td></tr>
            <tr><td style="padding:6px 16px 6px 0; color:#888;">Berangkat</td><td>{{ $schedule->departure_time->format('d M Y, H:i') }}</td></tr>
            <tr><td style="padding:6px 16px 6px 0; color:#888;">Tiba</td><td>{{ $schedule->arrival_time->format('d M Y, H:i') }}</td></tr>
            <tr><td style="padding:6px 16px 6px 0; color:#888;">Harga</td><td><strong>Rp {{ number_format($schedule->price, 0, ',', '.') }}</strong></td></tr>
            <tr><td style="padding:6px 16px 6px 0; color:#888;">Sisa Kursi</td><td>{{ $schedule->available_seats }}</td></tr>
        </table>

        @if(count($bookedSeats) > 0)
            <p style="margin-top:16px; color:#888; font-size:13px;">Kursi terpesan: {{ implode(', ', $bookedSeats) }}</p>
        @endif

        <div style="margin-top:20px;">
            <a href="{{ route('orders.create', $schedule) }}" class="btn btn-primary">Pesan Tiket</a>
            <a href="{{ route('schedules.index') }}" class="btn btn-secondary" style="margin-left:8px;">Kembali</a>
        </div>
    </div>
@endsection
