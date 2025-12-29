@extends('layouts.base')
@section('title')
    Tambah Lapangan
@endsection
@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Form Tambah Data</h5>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('lapangan.store') }}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_lapangan" class="form-label">Nama Lapangan</label>
                            <input type="text" value="{{old('nama_lapangan')}}" name="nama_lapangan" class="form-control" id="nama_lapangan" aria-describedby="nama_lapangan">
                            @error('nama_lapangan')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                                
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label">Foto</label>
                            <input type="file" name="img" class="form-control" id="img">
                            @error('img')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga_per_jam" class="form-label">Harga/Jam</label>
                            <input type="number" value="{{old('harga_per_jam')}}" name="harga_per_jam" class="form-control" id="harga_per_jam" aria-describedby="harga_per_jam">
                            @error('harga_per_jam')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                            
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option>Pilih status</option>
                                <option value="1" {{ old('status') ? '1' : 'selected' }}>Tersedia</option>
                                <option value="0" {{ old('status') ? '0' : 'selected' }}>Tidak tersedia</option>
                            </select>
                            @error('status')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                            
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" value="{{old('harga_per_jam')}}" name="keterangan" class="form-control" id="keterangan" aria-describedby="keterangan">
                            @error('keterangan')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div> 
                        @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <a href="{{ route('lapangan.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
