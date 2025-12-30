<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Badminton Court</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
        }

        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Background */
        .bg-decoration {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
        }

        .court-lines {
            width: 100%;
            height: 100%;
            background-image:
                repeating-linear-gradient(90deg, rgba(255,255,255,0.02) 0, transparent 2px, transparent 60px),
                repeating-linear-gradient(0deg, rgba(255,255,255,0.02) 0, transparent 2px, transparent 60px);
        }

        /* Card container */
        .login-container {
            width: 100%;
            max-width: 340px;
            padding: 12px;
            z-index: 2;
        }

        .login-card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 12px 35px rgba(0,0,0,0.35);
        }

        .card-header {
            background: linear-gradient(135deg, #1e88e5, #1565c0);
            padding: 10px;
            text-align: center;
        }

        .logo-circle {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 4px;
        }

        .logo-circle span {
            font-size: 20px;
        }

        .brand-title {
            color: white;
            font-size: 15px;
            font-weight: 700;
            margin: 0;
        }

        .brand-subtitle {
            color: rgba(255,255,255,0.85);
            font-size: 10px;
        }

        .card-body {
            padding: 12px;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 6px;
        }

        .welcome-text h4 {
            color: #1565c0;
            font-weight: 700;
            font-size: 15px;
        }

        label {
            font-size: 12px;
        }

        .form-control {
            border-radius: 6px;
            padding: 6px 8px;
            font-size: 12px;
        }

        .mb-2 {
            margin-bottom: 6px !important;
        }

        .btn {
            padding: 8px;
            font-size: 13px;
            font-weight: 600;
        }

        .alert {
            font-size: 11px;
            padding: 6px;
            border-radius: 6px;
            margin-bottom: 6px;
        }

        .footer-link {
            text-align: center;
            margin-top: 6px;
            font-size: 11px;
        }

        .footer-link a {
            text-decoration: none;
            font-weight: 600;
            color: #1e88e5;
        }

        /* Layar sangat pendek */
        @media (max-height: 620px) {
            .login-container {
                max-width: 320px;
            }

            .brand-title {
                font-size: 14px;
            }

            .welcome-text h4 {
                font-size: 14px;
            }

            label {
                font-size: 11px;
            }

            .form-control {
                padding: 5px 7px;
                font-size: 11px;
            }

            .btn {
                padding: 7px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<div class="bg-decoration">
    <div class="court-lines"></div>
</div>

<div class="login-container">
    <div class="login-card">

        <div class="card-header">
            <div class="logo-circle">
                <span>🏸</span>
            </div>
            <h1 class="brand-title">Badminton Court</h1>
            <div class="brand-subtitle">Sistem Sewa</div>
        </div>

        <div class="card-body">

            <div class="welcome-text">
                <h4>Register</h4>
            </div>

            @if ($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name') }}">
                            <input type="hidden" name="role" 
                                   value="user">
                                </div>
                                <div class="mb-3">
                                    <label>Nomor Telepon</label>
                                    <input type="number" name="no_telp" class="form-control"
                                           value="{{ old('no_telp') }}">
                                </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Buat Akun</button>

                    </form>

            <div class="footer-link">
                <a href="{{route('login')}}">Sudah punya akun</a>
            </div>

        </div>
    </div>
</div>

</body>
</html>
