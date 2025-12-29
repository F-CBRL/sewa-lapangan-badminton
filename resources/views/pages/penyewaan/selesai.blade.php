@extends('layouts.base')
@section('title', 'Penyewaan Selesai')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Penyewaan Selesai</h4>

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Lapangan</th>
                                    <th>Penyewa</th>
                                    <th>No HP</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($penyewaan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->lapangan->nama_lapangan ?? '-' }}</td>
                                        <td>{{ $item->pelanggan->nama ?? '-' }}</td>
                                        <td>{{ $item->pelanggan->no_hp ?? '-' }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                                        <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge bg-success">{{ ucfirst($item->status) }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data penyewaan selesai</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="mt-3">
                            {{ $penyewaan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
