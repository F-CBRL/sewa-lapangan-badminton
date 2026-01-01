<?php

namespace App\Http\Controllers;

use App\Models\PelangganModel;
use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = User::where('role', 'user')->get();
        return view('pages.pelanggan.index', compact('pelanggan'));
    }
    

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return redirect()->route('pelanggan.index');
    }

}
