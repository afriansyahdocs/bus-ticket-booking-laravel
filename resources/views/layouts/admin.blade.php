<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Bus Ticket')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <style>
        body{
            min-height:100vh;
            background:#f1f5f9;
            font-family:'Segoe UI', sans-serif;
        }
        .sidebar{
            width:260px;
            min-height:100vh;
            background:linear-gradient(
                180deg,
                #0f172a 0%,
                #1e3a8a 100%
            );
            padding:24px 16px;
            position:fixed;
            left:0;
            top:0;
            display:flex;
            flex-direction:column;
            box-shadow:4px 0 20px rgba(0,0,0,.08);
        }
        .brand{
            color:white;
            font-size:22px;
            font-weight:700;
            margin-bottom:32px;
        }
        .sidebar .nav-link{
            color:rgba(255,255,255,.75);
            border-radius:12px;
            padding:12px 16px;
            margin-bottom:8px;
            transition:.3s;
        }
        .sidebar .nav-link:hover{
            background:rgba(255,255,255,.12);
            color:white;
        }
        .sidebar .nav-link.active{
            background:white;
            color:#1e3a8a;
            font-weight:600;
        }
        .sidebar-footer{
            margin-top:auto;
            border-top:1px solid rgba(255,255,255,.15);
            padding-top:20px;
        }
        .main{
            margin-left:260px;
            padding:24px;
        }
        .topbar{
            background:white;
            border-radius:20px;
            padding:18px 24px;
            box-shadow:0 8px 20px rgba(0,0,0,.05);
            margin-bottom:24px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }
        .page-title{
            font-size:24px;
            font-weight:700;
            color:#0f172a;
        }
        .admin-name{
            color:#64748b;
            font-size:14px;
        }
        .content-card{
            background:white;
            border:none;
            border-radius:20px;
            padding:24px;
            box-shadow:0 8px 25px rgba(0,0,0,.05);
        }
        .btn-primary{
            background:#1e3a8a;
            border:none;
        }
        .btn-primary:hover{
            background:#1d4ed8;
        }
        .table{
            vertical-align:middle;
        }
        .table thead th{
            background:#f8fafc;
            color:#475569;
            border-bottom:none;
        }
        .card{
            border:none;
            border-radius:18px;
            box-shadow:0 6px 20px rgba(0,0,0,.05);
        }
        .form-control,
        .form-select{
            border-radius:12px;
            padding:10px 14px;
        }
        .form-control:focus,
        .form-select:focus{
            border-color:#1e3a8a;
            box-shadow:0 0 0 .2rem rgba(30,58,138,.15);
        }
        .badge{
            padding:.55rem .8rem;
            border-radius:999px;
        }
        .alert{
            border:none;
            border-radius:14px;
        }
        @media(max-width:992px){
            .sidebar{
                width:100%;
                min-height:auto;
                position:relative;
            }
            .main{
                margin-left:0;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            <i class="bi bi-bus-front-fill me-2"></i>
            Bus Ticket
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.buses.index') }}"
                   class="nav-link {{ request()->routeIs('admin.buses*') ? 'active' : '' }}">
                    <i class="bi bi-bus-front me-2"></i>
                    Kelola Bus
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.routes.index') }}"
                   class="nav-link {{ request()->routeIs('admin.routes*') ? 'active' : '' }}">
                    <i class="bi bi-map me-2"></i>
                    Kelola Rute
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.schedules.index') }}"
                   class="nav-link {{ request()->routeIs('admin.schedules*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event me-2"></i>
                    Kelola Jadwal
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}"
                   class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                    <i class="bi bi-receipt me-2"></i>
                    Kelola Pesanan
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="text-white mb-3">
                <i class="bi bi-person-circle me-1"></i>
                {{ auth()->user()->name }}
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right me-1"></i>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="main">
        <div class="topbar">
            <div class="page-title">
                @yield('title', 'Dashboard')
            </div>
            <div class="admin-name">
                Administrator
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger shadow-sm">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="content-card">
            @yield('content')
        </div>

    </main>
    
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
