@extends('layouts.admin')
@section('title', 'Kelola Jadwal')
@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <h2>Kelola Jadwal</h2>
        <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">+ Tambah Jadwal</a>
    </div>
    <div class="card">
        <table>
            <thead>
                <tr><th>Bus</th><th>Rute</th><th>Berangkat</th><th>Harga</th><th>Sisa Kursi</th><th>Status</th><th>Pesanan</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->bus->name }}</td>
                        <td>{{ $schedule->route->origin }} → {{ $schedule->route->destination }}</td>
                        <td>{{ $schedule->departure_time->format('d M Y, H:i') }}</td>
                        <td>Rp {{ number_format($schedule->price, 0, ',', '.') }}</td>
                        <td>{{ $schedule->available_seats }}</td>
                        <td><span class="badge badge-{{ $schedule->status }}">{{ $schedule->status }}</span></td>
                        <td>{{ $schedule->orders_count }}</td>
                        <td>
                            <a href="{{ route('admin.schedules.edit', $schedule) }}" class="btn btn-warning">Edit</a>
                            <form method="POST" action="{{ route('admin.schedules.destroy', $schedule) }}" style="display:inline"
                                  onsubmit="return confirm('Yakin hapus jadwal ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" style="text-align:center; color:#888;">Belum ada jadwal.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top:16px;">{{ $schedules->links() }}</div>
    </div>
@endsection
