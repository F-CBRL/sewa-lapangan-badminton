<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #1e88e5, #1565c0);
            padding: 15px 0;
            position: fixed;
            width: 100%;
            z-index: 9999;
        }

        .navbar-brand {
            font-size: 22px;
            font-weight: 700;
            color: white !important;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
        }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, #1e88e5, #1565c0);
            color: white;
            padding: 70px 0;
            text-align: center;
            height: 70vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero h1 {
            font-size: 40px;
            font-weight: 800;
        }

        .hero p {
            font-size: 18px;
            opacity: 0.9;
        }

        /* Courts */
        .courts {
            padding: 60px 0;
        }

        .court-card {
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .1);
            overflow: hidden;
            transition: .3s;
        }

        .court-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .court-image {
            height: 180px;
            overflow: hidden;
            position: relative;
        }


        .court-card:hover {
            transform: translateY(-8px);
        }

        .court-image {
            height: 180px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            position: relative;
            color: white;
        }

        .court-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: white;
            color: #1565c0;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .court-body {
            padding: 20px;
        }

        .court-name {
            font-size: 20px;
            font-weight: 700;
        }

        .court-price {
            font-size: 22px;
            font-weight: 700;
            color: #1e88e5;
            margin: 10px 0;
        }

        .btn-book {
            width: 100%;
            background: linear-gradient(135deg, #1e88e5, #1565c0);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-weight: 600;
        }

        .contact-section {
            padding: 80px 0;
            background: #f5f7fa;
        }

        .contact-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .contact-info-box {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: 0.3s;
        }

        .contact-info-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .contact-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #1e88e5, #1565c0);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: white;
            margin-bottom: 20px;
        }

        .contact-info-box h4 {
            font-weight: 700;
            color: #1565c0;
            margin-bottom: 10px;
        }

        .contact-info-box p {
            color: #666;
            margin: 0;
            font-size: 15px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 38px;
            font-weight: 800;
            color: #1565c0;
            margin-bottom: 10px;
        }

        .section-title p {
            color: #666;
            font-size: 16px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            padding: 12px 15px;
            transition: 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #1e88e5;
            box-shadow: 0 0 0 0.2rem rgba(30, 136, 229, 0.15);
        }

        .btn-submit {
            background: linear-gradient(135deg, #1e88e5, #1565c0);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 40px;
            font-weight: 600;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 136, 229, 0.3);
        }

        footer {
            background: #1a1a2e;
            color: white;
            padding: 30px 0;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">🏸 Badminton Court</a>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('penyewaan.show', Auth::user()->id) }}">Riwayat</a>
                    </li>
                @endauth

                <li class="nav-item">
                    @if (Auth::check())
                        <a class="nav-link" href="{{ route('booking') }}">Booking</a>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">Booking</a>
                    @endif
                </li>

                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>


    @yield('content')

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2025 Badminton Court Booking</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
