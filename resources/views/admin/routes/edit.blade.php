@extends('layouts.admin')
@section('title', 'Edit Rute')
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-semibold">
                    Edit Rute
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.routes.update', $route) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">
                            Kota Asal
                        </label>
                        <input type="text" name="origin" value="{{ old('origin', $route->origin) }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Kota Tujuan
                        </label>

                        <input type="text" name="destination" value="{{ old('destination', $route->destination) }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Jarak (KM)
                            <span class="text-muted fw-normal">
                                (Opsional)
                            </span>
                        </label>
                        <input type="number" name="distance_km" value="{{ old('distance_km', $route->distance_km) }}" class="form-control" step="0.01" min="0">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">
                            Estimasi Durasi (Menit)
                        </label>
                        <input type="number" name="estimated_duration" value="{{ old('estimated_duration', $route->estimated_duration) }}" class="form-control" min="1" required>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit"
                                class="btn btn-primary">
                            Update
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
