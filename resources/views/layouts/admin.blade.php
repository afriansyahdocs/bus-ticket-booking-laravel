<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', 'Bus Ticket')</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:Arial, sans-serif; font-size:14px; color:#333; background:#f0f2f5; display:flex; min-height:100vh; }

        /* Sidebar */
        .sidebar { width:220px; background:#1a1a2e; color:#fff; flex-shrink:0; display:flex; flex-direction:column; }
        .sidebar .brand { padding:20px 16px; font-size:16px; font-weight:bold; border-bottom:1px solid #2a2a4e; }
        .sidebar nav a { display:block; padding:12px 16px; color:#bbb; text-decoration:none; font-size:13px; border-left:3px solid transparent; }
        .sidebar nav a:hover, .sidebar nav a.active { color:#fff; background:#2a2a4e; border-left-color:#fff; }
        .sidebar .sidebar-footer { margin-top:auto; padding:16px; border-top:1px solid #2a2a4e; }
        .sidebar .sidebar-footer form button { background:none; border:none; color:#bbb; cursor:pointer; font-size:13px; }
        .sidebar .sidebar-footer form button:hover { color:#fff; }

        /* Main */
        .main { flex:1; display:flex; flex-direction:column; overflow:auto; }
        .topbar { background:#fff; padding:14px 24px; border-bottom:1px solid #ddd; display:flex; justify-content:space-between; align-items:center; }
        .topbar .page-title { font-size:16px; font-weight:bold; color:#1a1a2e; }
        .topbar .admin-name { font-size:13px; color:#888; }
        .content { padding:24px; flex:1; }

        /* Components */
        .card { background:#fff; border-radius:8px; border:1px solid #ddd; padding:20px; margin-bottom:16px; }
        .alert-success { background:#d4edda; color:#155724; padding:12px 16px; border-radius:6px; margin-bottom:16px; }
        .alert-error { background:#f8d7da; color:#721c24; padding:12px 16px; border-radius:6px; margin-bottom:16px; }
        .btn { display:inline-block; padding:7px 14px; border-radius:6px; text-decoration:none; font-size:13px; cursor:pointer; border:none; }
        .btn-primary { background:#1a1a2e; color:#fff; }
        .btn-primary:hover { background:#2a2a4e; }
        .btn-danger { background:#dc3545; color:#fff; }
        .btn-danger:hover { background:#c82333; }
        .btn-warning { background:#ffc107; color:#333; }
        .btn-warning:hover { background:#e0a800; }
        .btn-secondary { background:#6c757d; color:#fff; }
        table { width:100%; border-collapse:collapse; }
        th, td { padding:10px 12px; text-align:left; border-bottom:1px solid #eee; font-size:13px; }
        th { background:#f8f9fa; font-weight:bold; color:#555; }
        .badge { display:inline-block; padding:3px 8px; border-radius:4px; font-size:11px; font-weight:bold; text-transform:uppercase; }
        .badge-pending { background:#fff3cd; color:#856404; }
        .badge-confirmed { background:#d4edda; color:#155724; }
        .badge-cancelled { background:#f8d7da; color:#721c24; }
        .badge-active { background:#d4edda; color:#155724; }
        .badge-completed { background:#cce5ff; color:#004085; }
        .badge-economy { background:#e2e3e5; color:#383d41; }
        .badge-executive { background:#cce5ff; color:#004085; }
        .badge-sleeper { background:#e2d9f3; color:#432874; }
        .form-group { margin-bottom:14px; }
        .form-group label { display:block; margin-bottom:4px; font-size:13px; font-weight:bold; }
        .form-group input, .form-group select, .form-group textarea { width:100%; padding:8px 12px; border:1px solid #ccc; border-radius:6px; font-size:14px; }
        .form-group input:focus, .form-group select:focus { outline:none; border-color:#1a1a2e; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">🚌 Bus Ticket Admin</div>
    <nav>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">📊 Dashboard</a>
        <a href="{{ route('admin.buses.index') }}" class="{{ request()->routeIs('admin.buses*') ? 'active' : '' }}">🚌 Kelola Bus</a>
        <a href="{{ route('admin.routes.index') }}" class="{{ request()->routeIs('admin.routes*') ? 'active' : '' }}">🗺️ Kelola Rute</a>
        <a href="{{ route('admin.schedules.index') }}" class="{{ request()->routeIs('admin.schedules*') ? 'active' : '' }}">📅 Kelola Jadwal</a>
        <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}">📋 Kelola Pesanan</a>
    </nav>
    <div class="sidebar-footer">
        <div style="color:#bbb; font-size:12px; margin-bottom:8px;">{{ auth()->user()->name }}</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</div>

<div class="main">
    <div class="topbar">
        <div class="page-title">@yield('title', 'Dashboard')</div>
        <div class="admin-name">Administrator</div>
    </div>
    <div class="content">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-error">
                <ul style="margin-left:16px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </div>
</div>

</body>
</html>
