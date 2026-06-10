<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register — Bus Ticket</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a, #1e3a8a);
        }

        .auth-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,.15);
        }

        .auth-header {
            color: #1e3a8a;
            font-weight: 700;
        }

        .btn-register {
            background-color: #1e3a8a;
            border: none;
        }

        .btn-register:hover {
            background-color: #1d4ed8;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-md-6 col-lg-5">

                <div class="card auth-card">
                    <div class="card-body p-4">

                        <div class="text-center mb-4">
                            <h3 class="auth-header mb-1">Bus Ticket</h3>
                            <p class="text-muted">Buat akun baru</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>

                                <input type="text"
                                    name="name"
                                    class="form-control form-control-lg"
                                    value="{{ old('name') }}"
                                    required
                                    autofocus>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>

                                <input type="email"
                                    name="email"
                                    class="form-control form-control-lg"
                                    value="{{ old('email') }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">No. HP</label>

                                <input type="text"
                                    name="phone"
                                    class="form-control form-control-lg"
                                    value="{{ old('phone') }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>

                                <input type="password"
                                    name="password"
                                    class="form-control form-control-lg"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Konfirmasi Password</label>

                                <input type="password"
                                    name="password_confirmation"
                                    class="form-control form-control-lg"
                                    required>
                            </div>

                            <button type="submit"
                                    class="btn btn-register btn-lg text-white w-100">
                                Daftar
                            </button>
                        </form>

                        <p class="text-center mt-4 mb-0">
                            Sudah punya akun?
                            <a href="{{ route('login') }}"
                            class="text-decoration-none fw-semibold">
                                Login di sini
                            </a>
                        </p>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
