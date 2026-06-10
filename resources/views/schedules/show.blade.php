@extends('layouts.app')
@section('title', 'Detail Jadwal')
@section('content')

    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            Detail Jadwal
        </h2>
        <p class="text-muted mb-0">
            Informasi lengkap perjalanan bus.
        </p>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="fw-bold mb-4">
                {{ $schedule->route->origin }}
                →
                {{ $schedule->route->destination }}
            </h4>

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="150">Bus</th>
                            <td>{{ $schedule->bus->name }}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>{{ ucfirst($schedule->bus->bus_class) }}</td>
                        </tr>
                        <tr>
                            <th>Berangkat</th>
                            <td>
                                {{ $schedule->departure_time->format('d M Y, H:i') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Tiba</th>
                            <td>
                                {{ $schedule->arrival_time->format('d M Y, H:i') }}
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="150">Harga</th>
                            <td class="fw-bold text-primary">
                                Rp {{ number_format($schedule->price, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Sisa Kursi</th>
                            <td>
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
                            </td>
                        </tr>
                    </table>
                </div>
            </div>


            @if(count($bookedSeats) > 0)
                <hr>
                <h6 class="fw-semibold">
                    Kursi Terpesan
                </h6>
                <div class="d-flex flex-wrap gap-2 mt-3">
                    @foreach($bookedSeats as $seat)
                        <span class="badge text-bg-secondary">
                            {{ $seat }}
                        </span>
                    @endforeach
                </div>
            @endif

            <hr>
            <div class="d-flex flex-wrap gap-2"
                @if($schedule->available_seats > 0)
                    <a href="{{ route('orders.create', $schedule) }}"
                       class="btn btn-primary">
                        Pesan Tiket
                    </a>
                @endif
                <a href="{{ route('schedules.index') }}"
                   class="btn btn-outline-secondary">
                    Kembali
                </a>
            </div>
        </div>
    </div>

@endsection
