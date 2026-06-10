@extends('layouts.admin')
@section('title', 'Kelola Rute')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Kelola Rute</h4>
        <p class="text-muted mb-0">
            Daftar seluruh rute perjalanan bus.
        </p>
    </div>
    <a href="{{ route('admin.routes.create') }}"
       class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>
        Tambah Rute
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <th>Jarak</th>
                        <th>Estimasi</th>
                        <th>Jadwal</th>
                        <th width="170">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($routes as $route)
                        <tr>
                            <td class="fw-semibold">
                                {{ $route->origin }}
                            </td>
                            <td>
                                {{ $route->destination }}
                            </td>
                            <td>
                                {{ $route->distance_km ? $route->distance_km . ' km' : '-' }}
                            </td>
                            <td>
                                {{ $route->estimated_duration }} menit
                            </td>
                            <td>
                                <span class="badge bg-primary">
                                    {{ $route->schedules_count }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.routes.edit', $route) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.routes.destroy', $route) }}" onsubmit="return confirm('Yakin hapus rute ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                class="text-center text-muted py-4">
                                Belum ada data rute.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $routes->links() }}
        </div>

    </div>
</div>

@endsection
