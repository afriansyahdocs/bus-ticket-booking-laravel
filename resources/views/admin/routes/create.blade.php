@extends('layouts.admin')
@section('title', 'Tambah Rute')
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-semibold">
                    Tambah Rute Baru
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.routes.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">
                            Kota Asal
                        </label>
                        <input type="text" name="origin" value="{{ old('origin') }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Kota Tujuan
                        </label>
                        <input type="text" name="destination" value="{{ old('destination') }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Jarak (KM)
                            <span class="text-muted fw-normal">
                                (Opsional)
                            </span>
                        </label>
                        <input type="number" name="distance_km" value="{{ old('distance_km') }}" class="form-control" step="0.01" min="0">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">
                            Estimasi Durasi (Menit)
                        </label>
                        <input type="number" name="estimated_duration" value="{{ old('estimated_duration') }}" class="form-control" min="1" required>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                        <a href="{{ route('admin.routes.index') }}"
                           class="btn btn-outline-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
