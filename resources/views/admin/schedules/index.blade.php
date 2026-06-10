@extends('layouts.admin')
@section('title', 'Kelola Jadwal')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Kelola Jadwal</h4>
        <p class="text-muted mb-0">
            Kelola seluruh jadwal keberangkatan bus.
        </p>
    </div>
    <a href="{{ route('admin.schedules.create') }}"
       class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>
        Tambah Jadwal
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Bus</th>
                        <th>Rute</th>
                        <th>Keberangkatan</th>
                        <th>Harga</th>
                        <th>Sisa Kursi</th>
                        <th>Status</th>
                        <th>Pesanan</th>
                        <th width="170">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schedules as $schedule)
                        <tr>
                            <td>
                                <div class="fw-semibold">
                                    {{ $schedule->bus->name }}
                                </div>
                                <small class="text-muted">
                                    {{ $schedule->bus->bus_number }}
                                </small>
                            </td>
                            <td>
                                {{ $schedule->route->origin }}
                                →
                                {{ $schedule->route->destination }}
                            </td>
                            <td>
                                {{ $schedule->departure_time->format('d M Y') }}
                                <br>
                                <small class="text-muted">
                                    {{ $schedule->departure_time->format('H:i') }}
                                </small>
                            </td>
                            <td class="fw-semibold text-primary">
                                Rp {{ number_format($schedule->price, 0, ',', '.') }}
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    {{ $schedule->available_seats }}
                                </span>
                            </td>
                            <td>
                                @if($schedule->status == 'active')
                                    <span class="badge bg-success">
                                        Active
                                    </span>
                                @elseif($schedule->status == 'completed')
                                    <span class="badge bg-primary">
                                        Completed
                                    </span>
                                @elseif($schedule->status == 'cancelled')
                                    <span class="badge bg-danger">
                                        Cancelled
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $schedule->orders_count }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.schedules.edit', $schedule) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <form method="POST"
                                          action="{{ route('admin.schedules.destroy', $schedule) }}"
                                          onsubmit="return confirm('Yakin hapus jadwal ini?')">
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
                            <td colspan="8"
                                class="text-center text-muted py-4">
                                Belum ada jadwal.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $schedules->links() }}
        </div>
    </div>
</div>

@endsection
