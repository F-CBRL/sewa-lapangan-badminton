<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    public function index()
    {
        $lapangans = Lapangan::all();
        return view('pages.lapangan.index', compact('lapangans'));
    }

    public function create()
    {
        return view('pages.lapangan.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_lapangan' => 'required',
                'img' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'harga_per_jam' => 'required|numeric',
                'status' => 'required|in:0,1',
                'keterangan' => 'required|string',
            ],
            [
                'nama_lapangan.required' => 'Nama lapangan wajib diisi.',
                'img.required' => 'Gambar wajib diunggah.',
                'img.image' => 'File harus berupa gambar.',
                'img.mimes' => 'Gambar harus berformat jpg, jpeg, atau png.',
                'img.max' => 'Ukuran gambar maksimal 2MB.',
                'harga_per_jam.required' => 'Harga per jam wajib diisi.',
                'harga_per_jam.numeric' => 'Harga per jam harus berupa angka.',
                'status.required' => 'Status wajib diisi.',
                'status.in' => 'Status harus bernilai tersedia atau tidak tersedia',
                'keterangan.required' => 'Keterangan wajib diisi.',

            ]
        );

        $data = new Lapangan();
        $data->nama_lapangan = $request->nama_lapangan;
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $namaFile);
            $data->img = $namaFile;
        }
        $data->harga_per_jam = $request->harga_per_jam;
        $data->status = $request->status;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect()->route('lapangan.index');
    }


    public function show(Lapangan $lapangan)
    {
        //
    }

    public function edit($id)
    {
        $data = Lapangan::find($id);
        return view ('pages.lapangan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama_lapangan' => 'required',
                'img' => 'image|mimes:jpg,jpeg,png|max:2048',
                'harga_per_jam' => 'required|numeric',
                'status' => 'required|in:0,1',
                'keterangan' => 'required|string',
            ],
            [
                'nama_lapangan.required' => 'Nama lapangan wajib diisi.',
                'img.image' => 'File harus berupa gambar.',
                'img.mimes' => 'Gambar harus berformat jpg, jpeg, atau png.',
                'img.max' => 'Ukuran gambar maksimal 2MB.',
                'harga_per_jam.required' => 'Harga per jam wajib diisi.',
                'harga_per_jam.numeric' => 'Harga per jam harus berupa angka.',
                'status.required' => 'Status wajib diisi.',
                'status.in' => 'Status harus bernilai tersedia atau tidak tersedia',
                'keterangan.required' => 'Keterangan wajib diisi.',

            ]
        );

        $data = Lapangan::Find($id);
        $data->nama_lapangan = $request->nama_lapangan;
        if ($request->hasFile('img')) {

            // Hapus gambar lama
            if ($data->img && file_exists(public_path('img/' . $data->img))) {
                unlink(public_path('img/' . $data->img));
            }

            // Simpan gambar baru
            $namaFile = time() . '.' . $request->img->extension();
            $request->img->move(public_path('img'), $namaFile);

            $data->img = $namaFile;
        }
        $data->harga_per_jam = $request->harga_per_jam;
        $data->status = $request->status;
        $data->keterangan = $request->keterangan;
        $data->update();
        return redirect()->route('lapangan.index');
    }

    public function destroy($id)
    {
        $data = Lapangan::FindOrFail($id);
        if ($data->img && file_exists(public_path('img/' . $data->img))) {
            unlink(public_path('img/' . $data->img));
        }
        $data->delete();
        return redirect()->route('lapangan.index');
    }
}
