@extends('layouts.admin')
@section('title', 'Tambah Jadwal')
@section('content')
    <div style="max-width:500px;">
        <h2 style="margin-bottom:20px;">Tambah Jadwal</h2>
        <div class="card">
            <form method="POST" action="{{ route('admin.schedules.store') }}">
                @csrf
                <div class="form-group">
                    <label>Bus</label>
                    <select name="bus_id" required>
                        <option value="">-- Pilih Bus --</option>
                        @foreach($buses as $bus)
                            <option value="{{ $bus->id }}" {{ old('bus_id') == $bus->id ? 'selected' : '' }}>
                                {{ $bus->name }} ({{ $bus->bus_number }}) — {{ $bus->total_seats }} kursi
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Rute</label>
                    <select name="route_id" required>
                        <option value="">-- Pilih Rute --</option>
                        @foreach($routes as $route)
                            <option value="{{ $route->id }}" {{ old('route_id') == $route->id ? 'selected' : '' }}>
                                {{ $route->origin }} → {{ $route->destination }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Waktu Berangkat</label>
                    <input type="datetime-local" name="departure_time" value="{{ old('departure_time') }}" required>
                </div>
                <div class="form-group">
                    <label>Waktu Tiba</label>
                    <input type="datetime-local" name="arrival_time" value="{{ old('arrival_time') }}" required>
                </div>
                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price') }}" min="1000" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary" style="margin-left:8px;">Batal</a>
            </form>
        </div>
    </div>
@endsection
