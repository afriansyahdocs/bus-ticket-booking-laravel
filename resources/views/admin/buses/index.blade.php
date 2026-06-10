@extends('layouts.admin')
@section('title', 'Kelola Bus')
@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <h2>Kelola Bus</h2>
        <a href="{{ route('admin.buses.create') }}" class="btn btn-primary">+ Tambah Bus</a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr><th>Nama Bus</th><th>No. Bus</th><th>Kelas</th><th>Kursi</th><th>Jadwal</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($buses as $bus)
                    <tr>
                        <td>{{ $bus->name }}</td>
                        <td>{{ $bus->bus_number }}</td>
                        <td><span class="badge badge-{{ $bus->bus_class }}">{{ $bus->bus_class }}</span></td>
                        <td>{{ $bus->total_seats }}</td>
                        <td>{{ $bus->schedules_count }}</td>
                        <td>
                            <a href="{{ route('admin.buses.edit', $bus) }}" class="btn btn-warning">Edit</a>
                            <form method="POST" action="{{ route('admin.buses.destroy', $bus) }}" style="display:inline"
                                  onsubmit="return confirm('Yakin hapus bus ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center; color:#888;">Belum ada data bus.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top:16px;">{{ $buses->links() }}</div>
    </div>
@endsection
