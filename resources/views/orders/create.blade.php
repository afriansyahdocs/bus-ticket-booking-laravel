@extends('layouts.app')

@section('title', 'Pesan Tiket')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <div class="mb-4">
                <h3 class="fw-bold mb-2">Pesan Tiket</h3>
                <div class="text-muted">
                    <span class="fw-semibold">
                        {{ $schedule->route->origin }}
                    </span>
                    <span class="mx-2">→</span>
                    <span class="fw-semibold">
                        {{ $schedule->route->destination }}
                    </span>
                    <span class="mx-2">•</span>
                    {{ $schedule->departure_time->format('d M Y, H:i') }}
                    <span class="mx-2">•</span>
                    <span class="text-primary fw-bold">
                        Rp {{ number_format($schedule->price, 0, ',', '.') }}/orang
                    </span>
                </div>
            </div>

            <form method="POST" action="{{ route('orders.store') }}" id="order-form">
                @csrf
                <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                <div id="passengers">
                    {{-- Penumpang Pertama --}}
                    <div class="card mb-3 passenger-block border">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 fw-bold">
                                    Penumpang 1
                                </h6>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold">
                                        Nama Lengkap
                                    </label>
                                    <input type="text" name="passengers[0][passenger_name]" class="form-control" placeholder="Nama sesuai KTP" required>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold">
                                        NIK / No. KTP
                                    </label>
                                    <input type="text" name="passengers[0][id_number]" class="form-control" placeholder="16 digit NIK" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold">
                                        No. Kursi
                                    </label>
                                    <input type="number" name="passengers[0][seat_number]" class="form-control" placeholder="1-{{ $schedule->bus->total_seats }}" min="1" max="{{ $schedule->bus->total_seats }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2 mt-4">
                    <button type="button" onclick="addPassenger()" class="btn btn-outline-secondary">
                        + Tambah Penumpang
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Buat Pesanan
                    </button>
                    <a href="{{ route('schedules.index') }}" class="btn btn-light border">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let count = 1;
    const maxSeats = {{ $schedule->bus->total_seats }};

    function addPassenger() {
        const div = document.createElement('div');

        div.className = 'card mb-3 passenger-block border';

        div.innerHTML = `
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0 fw-bold">
                        Penumpang ${count + 1}
                    </h6>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.passenger-block').remove()">
                        Hapus
                    </button>
                </div>

                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label fw-semibold">
                            Nama Lengkap
                        </label>
                        <input type="text" name="passengers[${count}][passenger_name]" class="form-control" placeholder="Nama sesuai KTP" required>
                    </div>

                    <div class="col-md-5">
                        <label class="form-label fw-semibold">
                            NIK / No. KTP
                        </label>
                        <input type="text" name="passengers[${count}][id_number]" class="form-control" placeholder="16 digit NIK" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-semibold">
                            No. Kursi
                        </label>
                        <input type="number" name="passengers[${count}][seat_number]" class="form-control" placeholder="1-${maxSeats}" min="1" max="${maxSeats}" required>
                    </div>
                </div>
            </div>
        `;

        document.getElementById('passengers').appendChild(div);

        count++;
    }
</script>
@endsection
