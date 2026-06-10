<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register — Bus Ticket</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:Arial, sans-serif; background:#f5f5f5; display:flex; justify-content:center; align-items:center; min-height:100vh; }
        .card { background:#fff; border-radius:8px; border:1px solid #ddd; padding:32px; width:100%; max-width:400px; }
        h2 { margin-bottom:24px; color:#1a1a2e; }
        .form-group { margin-bottom:14px; }
        .form-group label { display:block; margin-bottom:4px; font-size:13px; font-weight:bold; }
        .form-group input { width:100%; padding:8px 12px; border:1px solid #ccc; border-radius:6px; font-size:14px; }
        .btn { display:block; width:100%; padding:10px; background:#1a1a2e; color:#fff; border:none; border-radius:6px; font-size:14px; cursor:pointer; }
        .alert-error { background:#f8d7da; color:#721c24; padding:10px 14px; border-radius:6px; margin-bottom:16px; font-size:13px; }
        p { margin-top:16px; font-size:13px; text-align:center; }
        a { color:#1a1a2e; }
    </style>
</head>
<body>
    <div class="card">
        <h2>🚌 Daftar Akun</h2>

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label>No. HP</label>
                <input type="text" name="phone" value="{{ old('phone') }}" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn">Daftar</button>
        </form>

        <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
    </div>
</body>
</html>
