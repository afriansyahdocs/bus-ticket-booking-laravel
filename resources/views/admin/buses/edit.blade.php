@extends('layouts.admin')
@section('title', 'Edit Bus')
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-semibold">
                    Edit Bus
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.buses.update', $bus) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">
                            Nama Bus
                        </label>
                        <input type="text" name="name" value="{{ old('name', $bus->name) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Nomor Bus
                        </label>
                        <input type="text" name="bus_number" value="{{ old('bus_number', $bus->bus_number) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Kelas Bus
                        </label>
                        <select name="bus_class" class="form-select" required>
                            <option value="economy"
                                {{ old('bus_class', $bus->bus_class) == 'economy' ? 'selected' : '' }}>
                                Economy
                            </option>
                            <option value="executive"
                                {{ old('bus_class', $bus->bus_class) == 'executive' ? 'selected' : '' }}>
                                Executive
                            </option>
                            <option value="sleeper"
                                {{ old('bus_class', $bus->bus_class) == 'sleeper' ? 'selected' : '' }}>
                                Sleeper
                            </option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">
                            Jumlah Kursi
                        </label>
                        <input type="number" name="total_seats" value="{{ old('total_seats', $bus->total_seats) }}" class="form-control" min="1" max="60" required>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit"
                                class="btn btn-primary">
                            Update
                        </button>
                        <a href="{{ route('admin.buses.index') }}"
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
