@extends('layouts.base')

@section('title')
    Edit Penyewaan
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Form Edit Penyewaan</h5>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('penyewaan.update', $penyewaan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Pilih Lapangan --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Lapangan</label>
                        <select name="lapangan_id" class="form-select">
                            <option value="">Pilih Lapangan</option>
                            @foreach ($lapangan as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('lapangan_id', $penyewaan->lapangan_id) == $item->id ? 'selected' : '' }}>
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
                        <label class="form-label">Nama Penyewa</label>
                        <select name="pelanggan_id" class="form-select">
                            <option value="">Pilih Pelanggan</option>
                            @foreach ($pelanggan as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('pelanggan_id', $penyewaan->pelanggan_id) == $item->id ? 'selected' : '' }}>
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
                        <label class="form-label">Tanggal Main</label>
                        <input type="date" name="tanggal"
                            value="{{ old('tanggal', $penyewaan->tanggal) }}"
                            class="form-control">
                        @error('tanggal')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jam Mulai --}}
                    <div class="mb-3">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai"
                            value="{{ old('jam_mulai', $penyewaan->jam_mulai) }}"
                            class="form-control">
                        @error('jam_mulai')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jam Selesai --}}
                    <div class="mb-3">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai"
                            value="{{ old('jam_selesai', $penyewaan->jam_selesai) }}"
                            class="form-control">
                        @error('jam_selesai')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                    <a href="{{ route('penyewaan.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
