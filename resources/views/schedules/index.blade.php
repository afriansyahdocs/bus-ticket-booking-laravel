@extends('layouts.app')
@section('title', 'Cari Jadwal')
@section('content')

    <div class="mb-4">
        <h2 class="fw-bold mb-1">Cari Jadwal Bus</h2>
        <p class="text-muted mb-0">
            Temukan jadwal perjalanan sesuai kebutuhan Anda.
        </p>
    </div>

    {{-- Form Pencarian --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('schedules.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Kota Asal</label>
                        <input type="text" name="origin" class="form-control" placeholder="Masukkan kota asal" value="{{ request('origin') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kota Tujuan</label>

                        <input type="text" name="destination" class="form-control" placeholder="Masukkan kota tujuan" value="{{ request('destination') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-primary">
                            Cari
                        </button>
                    </div>
                </div>

                @if(request()->filled(['origin', 'destination', 'date']))
                    <div class="mt-3">
                        <a href="{{ route('schedules.index') }}"
                           class="btn btn-outline-secondary btn-sm">
                            Reset Pencarian
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    {{-- Jadwal --}}
    @forelse ($schedules as $schedule)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <h5 class="fw-bold mb-2">
                            {{ $schedule->route->origin }}
                            →
                            {{ $schedule->route->destination }}
                        </h5>
                        <p class="text-muted mb-1">
                            {{ $schedule->bus->name }}
                            •
                            {{ ucfirst($schedule->bus->bus_class) }}
                        </p>
                        <small class="text-muted">
                            Berangkat:
                            {{ $schedule->departure_time->format('d M Y, H:i') }}
                        </small>
                    </div>

                    <div class="col-md-5 text-md-end mt-3 mt-md-0">
                        <h5 class="fw-bold text-primary mb-1">
                            Rp {{ number_format($schedule->price, 0, ',', '.') }}
                        </h5>
                        <div class="mb-3">
                            @if($schedule->available_seats > 10)
                                <span class="badge text-bg-success">
                                    {{ $schedule->available_seats }} kursi tersedia
                                </span>
                            @elseif($schedule->available_seats > 0)
                                <span class="badge text-bg-warning">
                                    Tersisa {{ $schedule->available_seats }} kursi
                                </span>
                            @else
                                <span class="badge text-bg-danger">
                                    Kursi habis
                                </span>
                            @endif
                        </div>

                        <div class="d-flex justify-content-md-end gap-2">
                            <a href="{{ route('schedules.show', $schedule) }}"
                               class="btn btn-outline-secondary">
                                Detail
                            </a>
                            @if($schedule->available_seats > 0)
                                <a href="{{ route('orders.create', $schedule) }}"
                                   class="btn btn-primary">
                                    Pesan
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="card">
            <div class="card-body text-center py-5">
                <h5 class="text-muted">
                    Tidak ada jadwal tersedia
                </h5>
                <p class="text-muted mb-0">
                    Coba ubah filter pencarian Anda.
                </p>
            </div>
        </div>
    @endforelse

    <div class="mt-4">
        {{ $schedules->links() }}
    </div>

@endsection
