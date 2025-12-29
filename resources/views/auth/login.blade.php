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
            overflow: hidden;
        }

        /* Background */
        .bg-decoration {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .court-lines {
            width: 100%;
            height: 100%;
            background-image:
                repeating-linear-gradient(90deg, rgba(255,255,255,0.02) 0, transparent 2px, transparent 60px),
                repeating-linear-gradient(0deg, rgba(255,255,255,0.02) 0, transparent 2px, transparent 60px);
        }

        /* Login box */
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 15px;
            z-index: 10;
        }

        .login-card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.35);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #1e88e5, #1565c0);
            padding: 22px 20px;
            text-align: center;
        }

        .logo-circle {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }

        .logo-circle span {
            font-size: 32px;
        }

        .brand-title {
            color: white;
            font-size: 20px;
            font-weight: 700;
            margin: 0;
        }

        .brand-subtitle {
            color: rgba(255,255,255,0.85);
            font-size: 12px;
        }

        .card-body {
            padding: 22px;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 15px;
        }

        .welcome-text h4 {
            color: #1565c0;
            font-weight: 700;
            font-size: 18px;
        }

        .welcome-text p {
            font-size: 13px;
            color: #666;
        }

        .form-label {
            font-weight: 600;
            font-size: 13px;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 14px;
        }

        .btn-login {
            background: linear-gradient(135deg, #1e88e5, #1565c0);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 14px;
            font-weight: 700;
            color: white;
            width: 100%;
            margin-top: 8px;
        }

        .alert {
            font-size: 13px;
            padding: 10px;
            border-radius: 10px;
        }

        .footer-link {
            text-align: center;
            margin-top: 12px;
            font-size: 13px;
        }

        .footer-link a {
            text-decoration: none;
            font-weight: 600;
            color: #1e88e5;
        }

        @media (max-width: 576px) {
            .login-container {
                max-width: 360px;
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
                <h4>Selamat Datang</h4>
                <p>Login untuk melanjutkan penyewaan</p>
            </div>

            @if ($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('login.process') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>

                    </form>

            <div class="footer-link">
                <a href="{{route('register')}}">Belum punya akun?</a>
            </div>

        </div>
    </div>
</div>

</body>
</html>
