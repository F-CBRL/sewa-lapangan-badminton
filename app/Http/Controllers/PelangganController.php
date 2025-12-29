<?php

namespace App\Http\Controllers;

use App\Models\PelangganModel;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = PelangganModel::all();
        return view('pages.pelanggan.index', compact('pelanggan'));
    }
    

    public function create()
    {
        return view ('pages.pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate (
            [
                'nama'=>'required|regex:/^[\pL\s]+$/u|regex:/^[\pL\s]+$/u',
                'no_hp'=>'required|max:13|min:10',
            ],
            [
                'nama.required' => 'nama wajib diisi.',
                'nama.regex' => 'Nama hanya boleh berisi huruf',
                'no_hp.required' => 'no hp wajib diisi.',
                'no_hp.max'=>'no hp maksimal 13 karakter.',
                'no_hp.min'=>'no hp minimal 10 karakter.',
            ],
        );
        $data=new PelangganModel();
        $data->nama=$request->nama;
        $data->no_hp=$request->no_hp;
        $data->save();
        return redirect()->route('pelanggan.index');
    }

    public function edit($id)
    {
        $data = PelangganModel::findOrFail($id);
        return view('pages.pelanggan.edit', compact('data'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate (
            [
                'nama' => 'required|regex:/^[\pL\s]+$/u',
                'no_hp'=>'required|max:13|min:10',
            ],
            [
                'nama.required' => 'nama wajib diisi.',
                'nama.regex' => 'Nama hanya boleh berisi huruf',
                'no_hp.required' => 'no hp wajib diisi.',
                'no_hp.max'=>'no hp maksimal 13 karakter.',
                'no_hp.min'=>'no hp minimal 10 karakter.',
            ],
        );
        $data=PelangganModel::findOrFail($id);
        $data->nama=$request->nama;
        $data->no_hp=$request->no_hp;
        $data->update();
        return redirect()->route('pelanggan.index');
    }

    public function destroy($id)
    {
        $data = PelangganModel::findOrFail($id);
        $data->delete();
        return redirect()->route('pelanggan.index');
    }

}
