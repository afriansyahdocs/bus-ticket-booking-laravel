<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Pesan Tiket</title></head>
<body>
    <h2>Pesan Tiket</h2>
    <p>{{ $schedule->route->origin }} → {{ $schedule->route->destination }}</p>
    <p>{{ $schedule->departure_time->format('d M Y, H:i') }} | Rp {{ number_format($schedule->price, 0, ',', '.') }}/orang</p>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('orders.store') }}" id="order-form">
        @csrf
        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">

        <div id="passengers">
            <div class="passenger">
                <h4>Penumpang 1</h4>
                <input type="text" name="passengers[0][passenger_name]" placeholder="Nama lengkap" required>
                <input type="text" name="passengers[0][id_number]" placeholder="NIK / No. KTP" required>
                <input type="number" name="passengers[0][seat_number]" placeholder="Nomor kursi" min="1" max="{{ $schedule->bus->total_seats }}" required>
            </div>
        </div>

        <button type="button" onclick="addPassenger()">+ Tambah Penumpang</button>
        <br><br>
        <button type="submit">Buat Pesanan</button>
        <a href="{{ route('schedules.index') }}">Batal</a>
    </form>

    <script>
        let count = 1;
        function addPassenger() {
            const div = document.createElement('div');
            div.className = 'passenger';
            div.innerHTML = `
                <h4>Penumpang ${count + 1}</h4>
                <input type="text" name="passengers[${count}][passenger_name]" placeholder="Nama lengkap" required>
                <input type="text" name="passengers[${count}][id_number]" placeholder="NIK / No. KTP" required>
                <input type="number" name="passengers[${count}][seat_number]" placeholder="Nomor kursi" min="1" max="{{ $schedule->bus->total_seats }}" required>
                <button type="button" onclick="this.parentElement.remove()">Hapus</button>
            `;
            document.getElementById('passengers').appendChild(div);
            count++;
        }
    </script>
</body>
</html>
