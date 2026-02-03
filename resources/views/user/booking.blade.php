@extends('user.layouts.app')
<style>
    .booking-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 30px 15px;
    }

    .booking-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: none;
    }

    .booking-header {
        background: linear-gradient(135deg, #1e88e5 0%, #1565c0 100%);
        padding: 40px 30px;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .booking-header::before {
        content: '🏸';
        position: absolute;
        font-size: 120px;
        opacity: 0.1;
        right: -20px;
        top: -20px;
        transform: rotate(20deg);
    }

    .booking-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 40px;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .booking-title {
        font-size: 28px;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .booking-subtitle {
        margin-top: 8px;
        opacity: 0.95;
        font-size: 15px;
    }

    .booking-body {
        padding: 40px 35px;
    }

    .form-section {
        margin-bottom: 35px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #1565c0;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e3f2fd;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-icon {
        font-size: 22px;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .label-icon {
        font-size: 18px;
        color: #1e88e5;
    }

    .form-control,
    .form-select {
        border: 2px solid #e3e8ef;
        border-radius: 12px;
        padding: 13px 16px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #1e88e5;
        box-shadow: 0 0 0 0.2rem rgba(30, 136, 229, 0.15);
        background: white;
        outline: none;
    }

    .form-control::placeholder {
        color: #adb5bd;
    }

    .time-selector {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .text-danger {
        font-size: 13px;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .file-upload-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }

    .file-upload-input {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        cursor: pointer;
    }

    .file-upload-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 40px 20px;
        background: #f8f9fa;
        border: 2px dashed #cbd5e0;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        color: #666;
    }

    .file-upload-label:hover {
        border-color: #1e88e5;
        background: #e3f2fd;
        color: #1565c0;
    }

    .file-upload-icon {
        font-size: 40px;
    }

    .file-name {
        margin-top: 10px;
        font-size: 14px;
        color: #1e88e5;
        font-weight: 600;
    }

    .btn-group-booking {
        display: flex;
        gap: 15px;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #e3e8ef;
    }

    .btn-submit {
        flex: 1;
        background: linear-gradient(135deg, #1e88e5 0%, #1565c0 100%);
        border: none;
        padding: 15px 30px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(30, 136, 229, 0.35);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(30, 136, 229, 0.45);
        background: linear-gradient(135deg, #1565c0 0%, #0d47a1 100%);
    }

    .btn-cancel {
        background: white;
        border: 2px solid #e3e8ef;
        padding: 15px 30px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        color: #666;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-cancel:hover {
        border-color: #1e88e5;
        color: #1e88e5;
        background: #f8f9fa;
        text-decoration: none;
    }

    .info-box {
        background: #e3f2fd;
        border-left: 4px solid #1e88e5;
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        display: flex;
        align-items: start;
        gap: 12px;
    }

    .info-icon {
        font-size: 24px;
        margin-top: 2px;
    }

    .info-text {
        flex: 1;
    }

    .info-title {
        font-weight: 700;
        color: #1565c0;
        margin-bottom: 5px;
        font-size: 14px;
    }

    .info-desc {
        color: #0d47a1;
        font-size: 13px;
        margin: 0;
    }

    @media (max-width: 768px) {
        .booking-body {
            padding: 30px 20px;
        }

        .time-selector {
            grid-template-columns: 1fr;
        }

        .btn-group-booking {
            flex-direction: column;
        }

        .booking-header {
            padding: 30px 20px;
        }

        .booking-title {
            font-size: 24px;
        }
    }
</style>
@section('title')
    Booking - Badminton Court Booking
@endsection
<div class="booking-container">
    <div class="card booking-card">
        <div class="booking-header">
            <div class="booking-icon">🏸</div>
            <h1 class="booking-title">Booking Lapanganmu</h1>
            <p class="booking-subtitle"></p>
        </div>

        <div class="booking-body">
            <div class="info-box">
                <div class="info-icon">💡</div>
                <div class="info-text">
                    <div class="info-title">Pemberitahuan</div>
                    <p class="info-desc">Buka dari jam 09:00 sampai 23:00.</p>
                </div>
            </div>

            <form action="{{ route('penyewaan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Section 1: Account Info --}}
                {{-- <div class="form-section">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">
                            <span class="label-icon">📧</span>
                            Akun Email
                        </label>
                        <select name="user_id" id="user_id" class="form-select">
                            <option value="">Email</option>
                            @foreach ($user as $item)
                                <option value="{{ $item->id }}" {{ old('user_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->email }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="text-danger mt-2">⚠️ {{ $message }}</div>
                        @enderror
                    </div>
                </div> --}}

                {{-- Section 2: Court Selection --}}
                <div class="form-section">
                    <div class="mb-3">
                        <label for="lapangan_id" class="form-label">
                            <span class="label-icon">🎯</span>
                            Lapangan
                        </label>
                        <select name="lapangan_id" id="lapangan_id" class="form-select">
                            <option value="">Pilih Lapangan</option>
                            @foreach ($lapangan as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('lapangan_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_lapangan }}
                                </option>
                            @endforeach
                        </select>
                        @error('lapangan_id')
                            <div class="text-danger mt-2">⚠️ {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Section 3: Date & Time --}}
                <div class="form-section">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">
                            <span class="label-icon">📆</span>
                            Tanggal Main
                        </label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}"
                            class="form-control">
                        @error('tanggal')
                            <div class="text-danger mt-2">⚠️ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="time-selector">
                        <div class="mb-3">
                            <label for="jam_mulai" class="form-label">
                                <span class="label-icon">⏰</span>
                                Waktu Mulai
                            </label>
                            <select id="jam_mulai" name="jam_mulai" class="form-select">
                                <option value="">-- Pilih Waktu --</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                                <option value="21:00">21:00</option>
                                <option value="22:00">22:00</option>
                            </select>
                            @error('jam_mulai')
                                <div class="text-danger mt-2">⚠️ {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jam_selesai" class="form-label">
                                <span class="label-icon">⏱️</span>
                                Waktu Selesai
                            </label>
                            <select id="jam_selesai" name="jam_selesai" class="form-select">
                                <option value="">-- Pilih Waktu --</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                                <option value="21:00">21:00</option>
                                <option value="22:00">22:00</option>
                                <option value="23:00">23:00</option>
                            </select>
                            @error('jam_selesai')
                                <div class="text-danger mt-2">⚠️ {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Section 4: Payment Proof --}}
                <div class="form-section">
                    <div class="section-title">
                        <span class="section-icon">💳</span>
                        Bukti Pembayaran
                    </div>

                    <div class="mb-3">
                        <label for="bukti" class="form-label">
                            <span class="label-icon">📎</span>
                            Upload bukti pembayaran
                        </label>
                        <div class="file-upload-wrapper">
                            <input type="file" name="bukti" class="form-control file-upload-input" id="bukti"
                                accept="image/*" onchange="displayFileName(this)">
                            <label class="file-upload-label" for="bukti">
                                <div>
                                    <div class="file-upload-icon">📤</div>
                                    <div>Click to upload or drag and drop</div>
                                    <small style="color: #999;">PNG, JPG up to 5MB</small>
                                </div>
                            </label>
                        </div>
                        <div id="file-name" class="file-name"></div>
                        @error('bukti')
                            <div class="text-danger mt-2">⚠️ {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="btn-group-booking">
                    <a href="{{ url('/') }}" class="btn-cancel">
                        Cancel
                    </a>
                    <button type="submit" class="btn-submit">
                        Booking sekarang
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function displayFileName(input) {
        const fileName = input.files[0]?.name;
        const fileNameDisplay = document.getElementById('file-name');
        if (fileName) {
            fileNameDisplay.textContent = '✓ ' + fileName;
        } else {
            fileNameDisplay.textContent = '';
        }
    }
</script>
