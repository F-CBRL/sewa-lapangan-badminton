@extends('layouts.base')
@section('title', 'Penyewaan Berjalan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sedang bermain</h4>

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
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($berjalan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->lapangan->nama_lapangan ?? '-' }}</td>
                                        <td>{{ $item->pelanggan->nama ?? '-' }}</td>
                                        <td>{{ $item->pelanggan->no_hp ?? '-' }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ ucfirst($item->status) }}</span>
                                        </td>
                                        <td>
                                            @if ($item->status == 'dipesan')
                                                <form action="{{ route('penyewaan.updateStatus', $item->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="berjalan">
                                                    <button class="btn btn-primary btn-sm"
                                                        onclick="return confirm('Mulai penyewaan?')">
                                                        Mulai
                                                    </button>
                                                </form>
                                            @elseif ($item->status == 'berjalan')
                                                <form action="{{ route('penyewaan.updateStatus', $item->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="selesai">
                                                    <button class="btn btn-success btn-sm"
                                                        onclick="return confirm('Selesaikan penyewaan?')">
                                                        Selesai
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada yang sedang bermain</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="mt-3">
                            {{ $berjalan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
