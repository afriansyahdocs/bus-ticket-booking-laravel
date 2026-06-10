@extends('layouts.admin')
@section('title', 'Tambah Bus')
@section('content')
    <div style="max-width:500px;">
        <h2 style="margin-bottom:20px;">Tambah Bus</h2>
        <div class="card">
            <form method="POST" action="{{ route('admin.buses.store') }}">
                @csrf
                <div class="form-group">
                    <label>Nama Bus</label>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label>Nomor Bus</label>
                    <input type="text" name="bus_number" value="{{ old('bus_number') }}" required>
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <select name="bus_class" required>
                        <option value="">-- Pilih Kelas --</option>
                        <option value="economy" {{ old('bus_class') === 'economy' ? 'selected' : '' }}>Economy</option>
                        <option value="executive" {{ old('bus_class') === 'executive' ? 'selected' : '' }}>Executive</option>
                        <option value="sleeper" {{ old('bus_class') === 'sleeper' ? 'selected' : '' }}>Sleeper</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah Kursi</label>
                    <input type="number" name="total_seats" value="{{ old('total_seats') }}" min="1" max="60" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.buses.index') }}" class="btn btn-secondary" style="margin-left:8px;">Batal</a>
            </form>
        </div>
    </div>
@endsection
