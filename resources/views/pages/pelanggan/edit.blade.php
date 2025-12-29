@extends('layouts.base')
@section('title')
    Edit Pelanggan
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">form edit pelanggan</h5>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pelanggan.update', $data->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" value="{{ old('nama', $data->nama) }}" name="nama" class="form-control"
                                id="nama" aria-describedby="nama">
                            @error('nama')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nama</label>
                            <input type="number" value="{{ old('no_hp', $data->no_hp) }}" name="no_hp" class="form-control"
                                id="no_hp" aria-describedby="no_hp">
                            @error('no_hp')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
