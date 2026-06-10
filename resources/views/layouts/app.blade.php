<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bus Ticket')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 14px; color: #333; background: #f5f5f5; }

        /* Navbar */
        nav { background: #1a1a2e; color: #fff; padding: 14px 24px; display: flex; justify-content: space-between; align-items: center; }
        nav .brand { font-size: 18px; font-weight: bold; color: #fff; text-decoration: none; }
        nav .nav-links a { color: #ccc; text-decoration: none; margin-left: 20px; font-size: 14px; }
        nav .nav-links a:hover { color: #fff; }
        nav .nav-links span { color: #ccc; margin-left: 20px; font-size: 14px; }

        /* Container */
        .container { max-width: 960px; margin: 30px auto; padding: 0 16px; }

        /* Card */
        .card { background: #fff; border-radius: 8px; border: 1px solid #ddd; padding: 20px; margin-bottom: 16px; }

        /* Alert */
        .alert-success { background: #d4edda; color: #155724; padding: 12px 16px; border-radius: 6px; margin-bottom: 16px; }
        .alert-error { background: #f8d7da; color: #721c24; padding: 12px 16px; border-radius: 6px; margin-bottom: 16px; }

        /* Button */
        .btn { display: inline-block; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; cursor: pointer; border: none; }
        .btn-primary { background: #1a1a2e; color: #fff; }
        .btn-primary:hover { background: #2a2a4e; }
        .btn-danger { background: #dc3545; color: #fff; }
        .btn-danger:hover { background: #c82333; }
        .btn-success { background: #28a745; color: #fff; }
        .btn-success:hover { background: #218838; }
        .btn-secondary { background: #6c757d; color: #fff; }
        .btn-secondary:hover { background: #5a6268; }

        /* Table */
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: bold; color: #555; font-size: 13px; }

        /* Badge */
        .badge { display: inline-block; padding: 3px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; text-transform: uppercase; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-confirmed { background: #d4edda; color: #155724; }
        .badge-cancelled { background: #f8d7da; color: #721c24; }
        .badge-paid { background: #d4edda; color: #155724; }
        .badge-failed { background: #f8d7da; color: #721c24; }

        /* Form */
        .form-group { margin-bottom: 14px; }
        .form-group label { display: block; margin-bottom: 4px; font-weight: bold; font-size: 13px; }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%; padding: 8px 12px; border: 1px solid #ccc;
            border-radius: 6px; font-size: 14px;
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none; border-color: #1a1a2e;
        }
    </style>
</head>
<body>

<nav>
    <a href="{{ route('dashboard') }}" class="brand">🚌 Bus Ticket</a>
    <div class="nav-links">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('schedules.index') }}">Cari Jadwal</a>
        <a href="{{ route('orders.index') }}">Pesanan Saya</a>
        <span>{{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit" style="background:none; border:none; color:#ccc; cursor:pointer; font-size:14px;">
                Logout
            </button>
        </form>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <ul style="margin-left:16px">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>

</body>
</html>
