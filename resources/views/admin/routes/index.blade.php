@extends('layouts.admin')
@section('title', 'Kelola Rute')
@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <h2>Kelola Rute</h2>
        <a href="{{ route('admin.routes.create') }}" class="btn btn-primary">+ Tambah Rute</a>
    </div>
    <div class="card">
        <table>
            <thead>
                <tr><th>Asal</th><th>Tujuan</th><th>Jarak (km)</th><th>Estimasi</th><th>Jadwal</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($routes as $route)
                    <tr>
                        <td>{{ $route->origin }}</td>
                        <td>{{ $route->destination }}</td>
                        <td>{{ $route->distance_km ?? '-' }}</td>
                        <td>{{ $route->estimated_duration }} menit</td>
                        <td>{{ $route->schedules_count }}</td>
                        <td>
                            <a href="{{ route('admin.routes.edit', $route) }}" class="btn btn-warning">Edit</a>
                            <form method="POST" action="{{ route('admin.routes.destroy', $route) }}" style="display:inline"
                                  onsubmit="return confirm('Yakin hapus rute ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center; color:#888;">Belum ada data rute.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top:16px;">{{ $routes->links() }}</div>
    </div>
@endsection
