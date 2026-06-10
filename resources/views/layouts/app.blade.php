<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Bus Ticket')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <style>
        body {
            background-color: #f8fafc;
            min-height: 100vh;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #0f172a, #1e3a8a);
            box-shadow: 0 4px 12px rgba(0,0,0,.1);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: .5px;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 5px 15px rgba(0,0,0,.08);
        }

        .btn-primary {
            background-color: #1e3a8a;
            border-color: #1e3a8a;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }

        .table thead th {
            background-color: #f8fafc;
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            border-bottom-width: 1px;
        }

        .badge {
            padding: 6px 10px;
            font-size: 12px;
        }

        main {
            padding: 30px 0;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">

            <a class="navbar-brand" href="{{ route('dashboard') }}">
                Bus Ticket
            </a>

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">

                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('schedules.index') }}">
                            Cari Jadwal
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('orders.index') }}">
                            Pesanan Saya
                        </a>
                    </li>

                </ul>

                <div class="d-flex align-items-center gap-3">

                    <span class="text-white">
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST"
                          action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                                class="btn btn-outline-light btn-sm">
                            Logout
                        </button>
                    </form>

                </div>

            </div>

        </div>
    </nav>

    <main>
        <div class="container">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </div>
    </main>
    
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
