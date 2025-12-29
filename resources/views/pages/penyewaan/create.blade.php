@extends('layouts.base')
@section('title')
    Tambah Penyewaan
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Form Tambah Penyewaan</h5>

            <div class="card">
                <div class="card-body">

                    <form action="{{ route('penyewaan.store') }}" method="POST">
                        @csrf

                        {{-- Pilih Lapangan --}}
                        <div class="mb-3">
                            <label for="lapangan_id" class="form-label">Nama Lapangan</label>
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
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Pilih Pelanggan --}}
                        <div class="mb-3">
                            <label for="pelanggan_id" class="form-label">Nama Penyewa</label>
                            <select name="pelanggan_id" id="pelanggan_id" class="form-select">
                                <option value="">Pilih Pelanggan</option>
                                @foreach ($pelanggan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('pelanggan_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }} - {{ $item->no_hp }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pelanggan_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tanggal --}}
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Main</label>
                            <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="form-control">
                            @error('tanggal')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jam Mulai --}}
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <div class="form-group">
                            <select id="time" name="jam_mulai" value="{{ old('jam_mulai') }}" class="form-select">
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
                                <option value="23:00">23:00</option>
                            </select>
                            @error('jam_mulai')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jam Selesai --}}
                        <div class="mb-3">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <div class="form-group">
                                <select id="time" name="jam_selesai" value="{{ old('jam_selesai') }}"
                                    class="form-select">
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
                                    <option value="23:00">23:00</option>
                                </select>
                                @error('jam_selesai')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            @error('jam_selesai')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        {{-- <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">Pilih Status</option>
                            <option value="dipesan" {{ old('status') == 'dipesan' ? 'selected' : '' }}>Dipesan</option>
                        </select>
                        @error('status')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div> --}}

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('penyewaan.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
