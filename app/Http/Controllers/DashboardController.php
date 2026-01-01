<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\PenyewaanModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $lapangan = Lapangan::all();

        $penyewaan = PenyewaanModel::where('status', 'dipesan')->count();
        $pendingBookings = PenyewaanModel::where('status', 'menunggu')->count();
        $bayar = PenyewaanModel::where('status', 'selesai')
            ->sum('total_harga');


        return view('dashboard', compact('lapangan', 'penyewaan', 'pendingBookings', 'bayar'));
    }
}
