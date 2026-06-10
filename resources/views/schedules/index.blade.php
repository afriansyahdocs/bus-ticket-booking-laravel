@extends('layouts.app')
@section('title', 'Cari Jadwal')
@section('content')
    <h2 style="margin-bottom:20px">Cari Jadwal Bus</h2>

    <div class="card" style="margin-bottom:20px;">
        <form method="GET" action="{{ route('schedules.index') }}" style="display:flex; gap:10px; flex-wrap:wrap;">
            <input type="text" name="origin" placeholder="Kota asal" value="{{ request('origin') }}" style="flex:1; padding:8px 12px; border:1px solid #ccc; border-radius:6px;">
            <input type="text" name="destination" placeholder="Kota tujuan" value="{{ request('destination') }}" style="flex:1; padding:8px 12px; border:1px solid #ccc; border-radius:6px;">
            <input type="date" name="date" value="{{ request('date') }}" style="padding:8px 12px; border:1px solid #ccc; border-radius:6px;">
            <button type="submit" class="btn btn-primary">Cari</button>
            <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Reset</a>
        </form>
    </div>

    @forelse ($schedules as $schedule)
        <div class="card">
            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;">
                <div>
                    <strong style="font-size:16px;">{{ $schedule->route->origin }} → {{ $schedule->route->destination }}</strong><br>
                    <span style="color:#888; font-size:13px;">{{ $schedule->bus->name }} • {{ ucfirst($schedule->bus->bus_class) }}</span><br>
                    <span style="color:#555; font-size:13px;">🕐 {{ $schedule->departure_time->format('d M Y, H:i') }}</span>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:18px; font-weight:bold; color:#1a1a2e;">Rp {{ number_format($schedule->price, 0, ',', '.') }}</div>
                    <div style="color:#888; font-size:12px;">Sisa {{ $schedule->available_seats }} kursi</div>
                    <div style="margin-top:8px;">
                        <a href="{{ route('schedules.show', $schedule) }}" class="btn btn-secondary" style="font-size:12px; padding:5px 10px;">Detail</a>
                        <a href="{{ route('orders.create', $schedule) }}" class="btn btn-primary" style="font-size:12px; padding:5px 10px; margin-left:6px;">Pesan</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="card" style="text-align:center; color:#888;">
            <p>Tidak ada jadwal tersedia.</p>
        </div>
    @endforelse

    {{ $schedules->links() }}
@endsection
