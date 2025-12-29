@extends('layouts.base')
@section('title', 'Data Lapangan')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="d-md-flex align-items-center">
            <div>
              <h4 class="card-title">Data Lapangan</h4>
            </div>
            <div class="ms-auto mt-3 mt-md-0">
                <a href="{{ route('lapangan.create') }}" class="btn btn-primary mb-3">
                    Tambah 
                </a>
            
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
          </div>
          <div class="table-responsive mt-4">
            <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lapangan</th>
                    <th>Foto</th>
                    <th>Harga / Jam</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($lapangans as $lapangan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $lapangan->nama_lapangan }}</td> 
                        <td>
                            <a href="{{ asset('img/'.$lapangan->img) }}" target="_blank">
                                <img src="{{ asset('img/'.$lapangan->img) }}" width="100">
                            </a>
                        </td>
                        <td>Rp {{ number_format($lapangan->harga_per_jam) }}</td>
                        <td>{{ $lapangan->status == 1 ? 'Tersedia' : 'Tidak tersedia' }}</td>
                        <td>{{ $lapangan->keterangan }}</td>
                        <td>
                            <a href="{{ route('lapangan.edit', $lapangan->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
    
                            <form action="{{ route('lapangan.destroy', $lapangan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            Data lapangan belum ada
                        </td>
                    </tr>
                @endforelse
            </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
