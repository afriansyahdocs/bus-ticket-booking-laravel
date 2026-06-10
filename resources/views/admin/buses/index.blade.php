@extends('layouts.admin')
@section('title', 'Kelola Bus')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Kelola Bus</h4>
        <p class="text-muted mb-0">
            Daftar seluruh armada bus yang tersedia.
        </p>
    </div>
    <a href="{{ route('admin.buses.create') }}"
       class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>
        Tambah Bus
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nama Bus</th>
                        <th>No. Bus</th>
                        <th>Kelas</th>
                        <th>Kursi</th>
                        <th>Jadwal</th>
                        <th width="170">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($buses as $bus)
                        <tr>
                            <td class="fw-semibold">
                                {{ $bus->name }}
                            </td>
                            <td>
                                {{ $bus->bus_number }}
                            </td>
                            <td>
                                @if($bus->bus_class == 'economy')
                                    <span class="badge bg-secondary">
                                        Economy
                                    </span>
                                @elseif($bus->bus_class == 'executive')
                                    <span class="badge bg-primary">
                                        Executive
                                    </span>
                                @elseif($bus->bus_class == 'sleeper')
                                    <span class="badge bg-dark">
                                        Sleeper
                                    </span>
                                @endif
                            </td>
                            <td>
                                {{ $bus->total_seats }}
                            </td>
                            <td>
                                {{ $bus->schedules_count }}
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.buses.edit', $bus) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <form method="POST"
                                          action="{{ route('admin.buses.destroy', $bus) }}"
                                          onsubmit="return confirm('Yakin hapus bus ini?')">
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
                                Belum ada data bus.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $buses->links() }}
        </div>
    </div>
</div>

@endsection
