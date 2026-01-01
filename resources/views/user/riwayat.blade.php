@extends('user.layouts.app')
@section('title')
    Riwayat Pemesanan - Badminton Court Booking
@endsection
@section('content')
    <div style="height: 80px;"></div>

    <!-- HERO SECTION -->
    <div class="hero" style="height: 40vh;">
        <div class="container">
            <h1>📋 Riwayat Pemesanan</h1>
            <p>Lihat semua booking lapangan badminton Anda</p>
        </div>
    </div>

    <!-- BOOKING HISTORY SECTION -->
    <section class="courts">
        <div class="container">

            <!-- Filter Status -->
            {{-- <div class="mb-4">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-book" style="width: auto;">Semua</button>
                    <button type="button" class="btn"
                        style="background: white; color: #1e88e5; border: 2px solid #1e88e5; border-radius: 10px; padding: 10px 20px; font-weight: 600;">Aktif</button>
                    <button type="button" class="btn"
                        style="background: white; color: #1e88e5; border: 2px solid #1e88e5; border-radius: 10px; padding: 10px 20px; font-weight: 600;">Selesai</button>
                    <button type="button" class="btn"
                        style="background: white; color: #1e88e5; border: 2px solid #1e88e5; border-radius: 10px; padding: 10px 20px; font-weight: 600;">Dibatalkan</button>
                </div>
            </div> --}}

            <!-- Booking Cards -->
            <div class="row">
                @forelse($bookings as $booking)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="court-card">
                            <div class="court-image" style="height: 120px; font-size: 40px;">
                                🏸
                                <span class="court-badge"
                                    style="background: 
                            @if ($booking->status == 'aktif') #28a745
                            @elseif($booking->status == 'selesai') #33ff33
                            @elseif($booking->status == 'menunggu') #FBC02D
                            @elseif($booking->status == 'dipesan') #007bff
                            @else #dc3545 @endif; color: white;">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>

                            <div class="court-body">
                                <div class="court-name">{{ $booking->user->name }}</div>

                                <div style="margin: 15px 0; padding: 15px; background: #f8f9fa; border-radius: 10px;">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                        <span style="color: #666; font-size: 14px;">📅 Tanggal</span>
                                        <span style="font-weight: 600; font-size: 14px;">{{ $booking->tanggal }}</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                        <span style="color: #666; font-size: 14px;">⏰ Waktu</span>
                                        <span style="font-weight: 600; font-size: 14px;">{{ $booking->jam_mulai }} -
                                            {{ $booking->jam_selesai ?? 0 }}</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between;">
                                        <span style="color: #666; font-size: 14px;">💰 Total</span>
                                        <span class="court-price" style="font-size: 16px; margin: 0;">Rp
                                            {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <div style="display: flex; gap: 10px;">
                                    {{-- <a href="{{ route('booking.detail', $booking->id) }}" class="btn-book"
                                        style="padding: 8px; font-size: 14px;">Detail</a> --}}
                                    @if ($booking->status == 'menunggu')
                                        <form action="{{ route('penyewaan.cancel', $booking->id) }}" method="POST"
                                            style="flex: 1;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="batal">
                                            <button type="submit" class="btn-book"
                                                style="background: linear-gradient(135deg, #dc3545, #c82333); padding: 8px; font-size: 14px;"
                                                onclick="return confirm('Yakin ingin membatalkan booking?')">Batalkan</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center" style="padding: 60px 0;">
                        <div style="font-size: 80px; opacity: 0.3;">📋</div>
                        <h3 style="color: #666; margin-top: 20px;">Belum Ada Riwayat Pemesanan</h3>
                        <p style="color: #999;">Yuk, mulai booking lapangan badminton sekarang!</p>
                        <a href="{{ route('home') }}" class="btn-book"
                            style="width: auto; padding: 12px 40px; margin-top: 20px; display: inline-block;">Lihat
                            Lapangan</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($bookings->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
