@extends('layouts.admin')
@section('title', 'Edit Jadwal')
@section('content')
    <div style="max-width:500px;">
        <h2 style="margin-bottom:20px;">Edit Jadwal</h2>
        <div class="card">
            <form method="POST" action="{{ route('admin.schedules.update', $schedule) }}">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Bus</label>
                    <select name="bus_id" required>
                        @foreach($buses as $bus)
                            <option value="{{ $bus->id }}" {{ old('bus_id', $schedule->bus_id) == $bus->id ? 'selected' : '' }}>
                                {{ $bus->name }} ({{ $bus->bus_number }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Rute</label>
                    <select name="route_id" required>
                        @foreach($routes as $route)
                            <option value="{{ $route->id }}" {{ old('route_id', $schedule->route_id) == $route->id ? 'selected' : '' }}>
                                {{ $route->origin }} → {{ $route->destination }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Waktu Berangkat</label>
                    <input type="datetime-local" name="departure_time" value="{{ old('departure_time', $schedule->departure_time->format('Y-m-d\TH:i')) }}" required>
                </div>
                <div class="form-group">
                    <label>Waktu Tiba</label>
                    <input type="datetime-local" name="arrival_time" value="{{ old('arrival_time', $schedule->arrival_time->format('Y-m-d\TH:i')) }}" required>
                </div>
                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $schedule->price) }}" min="1000" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="active" {{ old('status', $schedule->status) === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="cancelled" {{ old('status', $schedule->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ old('status', $schedule->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary" style="margin-left:8px;">Batal</a>
            </form>
        </div>
    </div>
@endsection
