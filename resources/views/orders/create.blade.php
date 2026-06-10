@extends('layouts.app')
@section('title', 'Pesan Tiket')
@section('content')
    <div class="card">
        <h2 style="margin-bottom:4px;">Pesan Tiket</h2>
        <p style="color:#888; margin-bottom:20px;">
            {{ $schedule->route->origin }} → {{ $schedule->route->destination }} •
            {{ $schedule->departure_time->format('d M Y, H:i') }} •
            Rp {{ number_format($schedule->price, 0, ',', '.') }}/orang
        </p>

        <form method="POST" action="{{ route('orders.store') }}" id="order-form">
            @csrf
            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">

            <div id="passengers">
                <div class="passenger-block" style="border:1px solid #eee; border-radius:6px; padding:16px; margin-bottom:12px;">
                    <strong>Penumpang 1</strong>
                    <div style="display:flex; gap:10px; margin-top:10px; flex-wrap:wrap;">
                        <div class="form-group" style="flex:1; min-width:160px;">
                            <label>Nama Lengkap</label>
                            <input type="text" name="passengers[0][passenger_name]" placeholder="Nama sesuai KTP" required>
                        </div>
                        <div class="form-group" style="flex:1; min-width:160px;">
                            <label>NIK / No. KTP</label>
                            <input type="text" name="passengers[0][id_number]" placeholder="16 digit NIK" required>
                        </div>
                        <div class="form-group" style="width:120px;">
                            <label>No. Kursi</label>
                            <input type="number" name="passengers[0][seat_number]" placeholder="1-{{ $schedule->bus->total_seats }}" min="1" max="{{ $schedule->bus->total_seats }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" onclick="addPassenger()" class="btn btn-secondary" style="margin-bottom:20px;">+ Tambah Penumpang</button>

            <div style="border-top:1px solid #eee; padding-top:16px;">
                <button type="submit" class="btn btn-primary">Buat Pesanan</button>
                <a href="{{ route('schedules.index') }}" class="btn btn-secondary" style="margin-left:8px;">Batal</a>
            </div>
        </form>
    </div>

    <script>
        let count = 1;
        const maxSeats = {{ $schedule->bus->total_seats }};
        function addPassenger() {
            const div = document.createElement('div');
            div.className = 'passenger-block';
            div.style = 'border:1px solid #eee; border-radius:6px; padding:16px; margin-bottom:12px;';
            div.innerHTML = `
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <strong>Penumpang ${count + 1}</strong>
                    <button type="button" onclick="this.closest('.passenger-block').remove()" style="background:none; border:none; color:#dc3545; cursor:pointer; font-size:13px;">Hapus</button>
                </div>
                <div style="display:flex; gap:10px; margin-top:10px; flex-wrap:wrap;">
                    <div style="flex:1; min-width:160px;">
                        <label style="display:block; margin-bottom:4px; font-size:13px; font-weight:bold;">Nama Lengkap</label>
                        <input type="text" name="passengers[${count}][passenger_name]" placeholder="Nama sesuai KTP" required style="width:100%; padding:8px 12px; border:1px solid #ccc; border-radius:6px;">
                    </div>
                    <div style="flex:1; min-width:160px;">
                        <label style="display:block; margin-bottom:4px; font-size:13px; font-weight:bold;">NIK / No. KTP</label>
                        <input type="text" name="passengers[${count}][id_number]" placeholder="16 digit NIK" required style="width:100%; padding:8px 12px; border:1px solid #ccc; border-radius:6px;">
                    </div>
                    <div style="width:120px;">
                        <label style="display:block; margin-bottom:4px; font-size:13px; font-weight:bold;">No. Kursi</label>
                        <input type="number" name="passengers[${count}][seat_number]" placeholder="1-${maxSeats}" min="1" max="${maxSeats}" required style="width:100%; padding:8px 12px; border:1px solid #ccc; border-radius:6px;">
                    </div>
                </div>
            `;
            document.getElementById('passengers').appendChild(div);
            count++;
        }
    </script>
@endsection
