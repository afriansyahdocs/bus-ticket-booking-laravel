@extends('layouts.admin')
@section('title', 'Edit Jadwal')
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-semibold">
                    Edit Jadwal
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.schedules.update', $schedule) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Bus</label>
                        <select name="bus_id" class="form-select" required>
                            @foreach($buses as $bus)
                                <option value="{{ $bus->id }}"
                                    {{ old('bus_id', $schedule->bus_id) == $bus->id ? 'selected' : '' }}>
                                    {{ $bus->name }}
                                    ({{ $bus->bus_number }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rute</label>
                        <select name="route_id" class="form-select" required>
                            @foreach($routes as $route)
                                <option value="{{ $route->id }}"
                                    {{ old('route_id', $schedule->route_id) == $route->id ? 'selected' : '' }}>

                                    {{ $route->origin }}
                                    →
                                    {{ $route->destination }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Waktu Berangkat
                            </label>
                            <input type="datetime-local" name="departure_time" value="{{ old('departure_time', $schedule->departure_time->format('Y-m-d\TH:i')) }}" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Waktu Tiba
                            </label>
                            <input type="datetime-local" name="arrival_time" alue="{{ old('arrival_time', $schedule->arrival_time->format('Y-m-d\TH:i')) }}"class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Harga Tiket (Rp)
                        </label>
                        <input type="number" name="price" value="{{ old('price', $schedule->price) }}" class="form-control" min="1000" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">
                            Status Jadwal
                        </label>
                        <select name="status" class="form-select" required>
                            <option value="active"
                                {{ old('status', $schedule->status) == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="completed"
                                {{ old('status', $schedule->status) == 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>
                            <option value="cancelled"
                                {{ old('status', $schedule->status) == 'cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                        <a href="{{ route('admin.schedules.index') }}" class="btn btn-outline-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
