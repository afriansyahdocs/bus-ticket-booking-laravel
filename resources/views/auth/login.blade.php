<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login — Bus Ticket</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:Arial, sans-serif; background:#f5f5f5; display:flex; justify-content:center; align-items:center; min-height:100vh; }
        .card { background:#fff; border-radius:8px; border:1px solid #ddd; padding:32px; width:100%; max-width:400px; }
        h2 { margin-bottom:24px; color:#1a1a2e; }
        .form-group { margin-bottom:14px; }
        .form-group label { display:block; margin-bottom:4px; font-size:13px; font-weight:bold; }
        .form-group input { width:100%; padding:8px 12px; border:1px solid #ccc; border-radius:6px; font-size:14px; }
        .btn { display:block; width:100%; padding:10px; background:#1a1a2e; color:#fff; border:none; border-radius:6px; font-size:14px; cursor:pointer; text-align:center; }
        .alert-error { background:#f8d7da; color:#721c24; padding:10px 14px; border-radius:6px; margin-bottom:16px; font-size:13px; }
        p { margin-top:16px; font-size:13px; text-align:center; }
        a { color:#1a1a2e; }
    </style>
</head>
<body>
    <div class="card">
        <h2>🚌 Login</h2>

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group" style="display:flex; align-items:center; gap:8px;">
                <input type="checkbox" name="remember" id="remember" style="width:auto;">
                <label for="remember" style="font-weight:normal; font-size:13px;">Ingat saya</label>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>

        <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
    </div>
</body>
</html>
