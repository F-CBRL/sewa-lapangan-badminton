@extends('layouts.base')
@section('title', 'Sewa Lapangan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Menunggu Konfirmasi</h4>
                        </div>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Akun</th>
                                    <th>Penyewa</th>
                                    <th>Lapangan</th>
                                    <th>No HP</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Total Harga</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($menunggu as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->email ?? '-' }}</td>
                                        <td>{{ $item->user->name ?? '-' }}</td>
                                        <td>{{ $item->lapangan->nama_lapangan ?? '-' }}</td>
                                        <td>{{ $item->user->no_telp ?? '-' }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>
                                            {{ $item->jam_mulai }} - {{ $item->jam_selesai }}
                                        </td>
                                        <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ asset('bukti/'.$item->bukti) }}" target="_blank">
                                                <img src="{{ asset('bukti/'.$item->bukti) }}" width="100">
                                            </a>
                                        </td>
                                        
                                        <td>
                                            <span
                                                class="badge 
                                            @if ($item->status == 'menunggu') bg-primary
                                            @elseif ($item->status == 'dipesan') bg-warning
                                            @elseif($item->status == 'berjalan') bg-primary
                                            @elseif($item->status == 'selesai') bg-success
                                            @else bg-danger @endif">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>

                                        <td>
                                            <form action="{{ route('penyewaan.updateStatus', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="dipesan">
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="return confirm('Terima penyewaan ini?')">
                                                    Terima
                                                </button>
                                            </form>
                                        
                                            <form action="{{ route('penyewaan.updateStatus', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="batal">
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin membatalkan pesanan?')">
                                                    Batalkan
                                                </button>
                                            </form>
                                        </td>                                        
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            Data penyewaan belum ada
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
