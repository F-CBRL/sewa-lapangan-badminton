@extends('user.layouts.app')
@section('content')
    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <h1>Sewa Lapangan Badmintonmu</h1>
            <p>Mudah, cepat, dan fleksibel</p>
        </div>
    </section>
    <!-- COURTS -->
    <section class="courts">
        <div class="container">

            <div class="text-center mb-5">
                <h2 class="fw-bold text-primary">Daftar Lapangan</h2>
                <p>Pilih lapangan favoritmu</p>
            </div>

            <div class="row">
                @foreach ($data as $lapangan)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card court-card">

                            <div class="court-image">
                                <a href="{{ asset('img/' . $lapangan->img) }}" target="_blank">
                                    <img src="{{ asset('img/' . $lapangan->img) }}" width="100%">
                                </a>
                                <div class="court-badge">
                                    {{ $lapangan->status == 1 ? 'Available' : 'Booked' }}
                                </div>
                            </div>

                            <div class="court-body">
                                <div class="court-name">
                                    {{ $lapangan->nama_lapangan }}
                                </div>

                                <div class="court-price">
                                    Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}
                                    <small>/ jam</small>
                                </div>

                                @if ($lapangan->status == 1)
                                    @if (Auth::check())
                                        <a href="{{ url('/booking') }}" class="btn btn-book">Sewa Sekarang</a>
                                    @else
                                        <a href="{{ url('/login') }}" class="btn btn-book">Sewa Sekarang</a>
                                    @endif
                                @else
                                    <button class="btn btn-secondary w-100" disabled>
                                        Tidak Tersedia
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
