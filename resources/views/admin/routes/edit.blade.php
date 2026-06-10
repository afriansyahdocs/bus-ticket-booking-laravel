@extends('layouts.admin')
@section('title', 'Edit Rute')
@section('content')
    <div style="max-width:500px;">
        <h2 style="margin-bottom:20px;">Edit Rute</h2>
        <div class="card">
            <form method="POST" action="{{ route('admin.routes.update', $route) }}">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Kota Asal</label>
                    <input type="text" name="origin" value="{{ old('origin', $route->origin) }}" required>
                </div>
                <div class="form-group">
                    <label>Kota Tujuan</label>
                    <input type="text" name="destination" value="{{ old('destination', $route->destination) }}" required>
                </div>
                <div class="form-group">
                    <label>Jarak (km) <span style="color:#888; font-weight:normal;">- opsional</span></label>
                    <input type="number" name="distance_km" value="{{ old('distance_km', $route->distance_km) }}" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label>Estimasi Durasi (menit)</label>
                    <input type="number" name="estimated_duration" value="{{ old('estimated_duration', $route->estimated_duration) }}" min="1" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.routes.index') }}" class="btn btn-secondary" style="margin-left:8px;">Batal</a>
            </form>
        </div>
    </div>
@endsection
