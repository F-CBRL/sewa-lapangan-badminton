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

                        {{-- Pilih akun --}}
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Nama akun pemesan</label>
                            <select name="user_id" id="user_id" class="form-select">
                                <option value="">Pilih Pemesan</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}" {{ old('user_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->email }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Pilih Lapangan --}}
                        <div class="mb-3">
                            <label for="lapangan_id" class="form-label">Pilih Lapangan</label>
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
                            <select id="jam_mulai" name="jam_mulai" class="form-select">
                                <option value="">-- Pilih Waktu --</option>
                                @for ($i = 9; $i <= 23; $i++)
                                    @php
                                        $jam = sprintf('%02d:00', $i);
                                    @endphp
                                    <option value="{{ $jam }}" {{ old('jam_mulai') == $jam ? 'selected' : '' }}>
                                        {{ $jam }}
                                    </option>
                                @endfor
                            </select>
                            
                            @error('jam_mulai')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jam Selesai --}}
                        <div class="mb-3">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <div class="form-group">
                                <select id="jam_selesai" name="jam_selesai" class="form-select">
                                    <option value="">-- Pilih Waktu --</option>
                                    @for ($i = 9; $i <= 23; $i++)
                                        @php
                                            $jam = sprintf('%02d:00', $i);
                                        @endphp
                                        <option value="{{ $jam }}" {{ old('jam_selesai') == $jam ? 'selected' : '' }}>
                                            {{ $jam }}
                                        </option>
                                    @endfor
                                </select>                                
                                @error('jam_selesai')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

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
