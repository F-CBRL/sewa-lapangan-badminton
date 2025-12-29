<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\PelangganModel;
use App\Models\PenyewaanModel;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PenyewaanController extends Controller
{
    public function getSuccess(Request $request)
    {
        $paginate = $request->input('paginate', 10);
        $penyewaan = PenyewaanModel::where('status', 'selesai')->paginate($paginate);

        return view('pages.penyewaan.selesai', compact('penyewaan'));
    }

    public function getPlay(Request $request)
    {
        $paginate = $request->input('paginate', 10);
        $berjalan = PenyewaanModel::where('status', 'berjalan')->paginate($paginate);

        return view('pages.penyewaan.berjalan', compact('berjalan'));
    }

    public function createUser(){
        $lapangan  = Lapangan::where('status', 1)->get();
        $user = User::all();

        return view('user.booking', compact('lapangan','user'));
    }

    private function updateStatusOtomatis()
    {
        $now     = Carbon::now('Asia/Makassar');
        $tanggal = $now->toDateString();
        $jamNow  = $now->format('H:i:s');

        // dipesan → berjalan
        PenyewaanModel::where('tanggal', $tanggal)
            ->where('status', 'dipesan')
            ->where('jam_mulai', '<=', $jamNow)
            ->where('jam_selesai', '>', $jamNow)
            ->update(['status' => 'berjalan']);

        // berjalan/dipesan → selesai
        PenyewaanModel::where('tanggal', $tanggal)
            ->whereIn('status', ['dipesan', 'berjalan'])
            ->where('jam_selesai', '<=', $jamNow)
            ->update(['status' => 'selesai']);
    }

    public function index()
    {
        $this->updateStatusOtomatis();

        $now = \Carbon\Carbon::now('Asia/Makassar');
        $jamNow = $now->format('H:i:s');

        $penyewaan = PenyewaanModel::with(['lapangan', 'user'])
            ->whereIn('status', ['dipesan'])
            ->get();

        return view('pages.penyewaan.index', compact('penyewaan', 'jamNow'));
    }

    public function create()
    {
        $lapangan  = Lapangan::where('status', 1)->get();
        $user = User::all();

        return view('pages.penyewaan.create', compact('lapangan','user'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'lapangan_id'  => 'required|exists:lapangans,id',
                'user_id' => 'required|exists:users,id',
                'tanggal'      => 'required|date|after_or_equal:today',
                'jam_mulai'    => [
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        $tanggal = Carbon::parse($request->tanggal);
                        $jamSekarang = Carbon::now('Asia/Makassar');

                        // jika tanggal sama dengan hari ini
                        if ($tanggal->isToday()) {
                            $jamMulai = Carbon::parse($value);
                            if ($jamMulai->lt($jamSekarang)) {
                                $fail('Jam mulai tidak boleh sebelum jam sekarang.');
                            }
                        }
                    }
                ],
                'jam_selesai'  => 'required|after:jam_mulai',
            ],
            [
                'lapangan_id.required'  => 'Lapangan wajib diisi.',
                'lapangan_id.exists'    => 'Lapangan tidak valid.',
                'user_id.required' => 'Pelanggan wajib diisi.',
                'user_id.exists'   => 'Pelanggan tidak valid.',
                'tanggal.required'      => 'Tanggal wajib diisi.',
                'tanggal.date'          => 'Tanggal tidak valid.',
                'tanggal.after_or_equal' => 'Tanggal tidak boleh sebelum hari ini.',
                'jam_mulai.required'    => 'Jam mulai wajib diisi.',
                'jam_selesai.required'  => 'Jam selesai wajib diisi.',
                'jam_selesai.after'     => 'Jam selesai harus setelah jam mulai.',
            ]
        );

        // cek bentrok
        $bentrok = PenyewaanModel::where('lapangan_id', $request->lapangan_id)
            ->where('tanggal', $request->tanggal)
            ->whereIn('status', ['dipesan'])
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('jam_mulai', '<', $request->jam_selesai)
                            ->where('jam_selesai', '>', $request->jam_mulai);
                    });
            })
            ->exists();


        if ($bentrok) {
            return back()
                ->withErrors(['jam_mulai' => 'Jam tersebut sudah dipesan'])
                ->withInput();
        }

        $lapangan = Lapangan::findOrFail($request->lapangan_id);

        $jamMulai   = strtotime($request->jam_mulai);
        $jamSelesai = strtotime($request->jam_selesai);
        $durasi     = ($jamSelesai - $jamMulai) / 3600;

        $penyewaan = new PenyewaanModel();
        $penyewaan->user_id     = $request->user_id;
        $penyewaan->lapangan_id  = $request->lapangan_id;
        $penyewaan->tanggal      = $request->tanggal;
        $penyewaan->jam_mulai    = $request->jam_mulai;
        $penyewaan->jam_selesai  = $request->jam_selesai;
        $penyewaan->total_harga  = $durasi * $lapangan->harga_per_jam;
        $penyewaan->status       = 'dipesan';
        $penyewaan->save();
        
        if (FacadesAuth::user()->role === 'admin') {
            return redirect()->route('penyewaan.index')
                ->with('success', 'Penyewaan berhasil ditambahkan');
        } else {
            return redirect()->route('home')
                ->with('success', 'Penyewaan berhasil ditambahkan');
        }
        
    }

    public function edit($id)
    {
        $penyewaan = PenyewaanModel::findOrFail($id);
        $lapangan  = Lapangan::where('status', 1)->get();
        $user = User::all();

        return view('pages.penyewaan.edit', compact(
            'penyewaan',
            'lapangan',
            'user'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'lapangan_id'  => 'required|exists:lapangans,id',
                'pelanggan_id' => 'required|exists:pelanggan,id',
                'tanggal'      => 'required|date',
                'jam_mulai'    => 'required',
                'jam_selesai'  => 'required|after:jam_mulai',
            ],
            [
                'lapangan_id.required'  => 'Lapangan wajib diisi.',
                'lapangan_id.exists'    => 'Lapangan tidak valid.',
                'pelanggan_id.required' => 'Pelanggan wajib diisi.',
                'pelanggan_id.exists'   => 'Pelanggan tidak valid.',
                'tanggal.required'      => 'Tanggal wajib diisi.',
                'tanggal.date'          => 'Tanggal tidak valid.',
                'jam_mulai.required'    => 'Jam mulai wajib diisi.',
                'jam_selesai.required'  => 'Jam selesai wajib diisi.',
                'jam_selesai.after'     => 'Jam selesai harus setelah jam mulai.',
            ]
        );

        $penyewaan = PenyewaanModel::findOrFail($id);

        $bentrok = PenyewaanModel::where('lapangan_id', $request->lapangan_id)
            ->where('tanggal', $request->tanggal)
            ->whereIn('status', ['dipesan', 'berjalan'])
            ->where('id', '!=', $id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('jam_mulai', '<', $request->jam_selesai)
                            ->where('jam_selesai', '>', $request->jam_mulai);
                    });
            })
            ->exists();


        if ($bentrok) {
            return back()
                ->withErrors(['jam_mulai' => 'Jam tersebut sudah dipesan'])
                ->withInput();
        }

        $lapangan = Lapangan::findOrFail($request->lapangan_id);

        $jamMulai   = strtotime($request->jam_mulai);
        $jamSelesai = strtotime($request->jam_selesai);
        $durasi     = ($jamSelesai - $jamMulai) / 3600;

        $penyewaan->user_id     = $request->user_id;
        $penyewaan->lapangan_id  = $request->lapangan_id;
        $penyewaan->tanggal      = $request->tanggal;
        $penyewaan->jam_mulai    = $request->jam_mulai;
        $penyewaan->jam_selesai  = $request->jam_selesai;
        $penyewaan->total_harga  = $durasi * $lapangan->harga_per_jam;
        $penyewaan->save();

        return redirect()->route('penyewaan.index')
            ->with('success', 'Penyewaan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $penyewaan = PenyewaanModel::findOrFail($id);
        $penyewaan->delete();

        return redirect()->route('penyewaan.index')
            ->with('success', 'Penyewaan berhasil dihapus');
    }

    public function updateStatus(Request $request, $id)
    {
        $status = PenyewaanModel::findOrFail($id);
        $now = \Carbon\Carbon::now('Asia/Makassar');
        $tanggalNow = $now->toDateString();
        $jamNow = $now->format('H:i:s');

        if ($request->status == 'berjalan') {
            if ($status->tanggal != $tanggalNow || $status->jam_mulai > $jamNow) {
                return redirect()->route('penyewaan.index')
                    ->with('error', 'Tidak dapat mengubah status menjadi berjalan sebelum waktu mulai penyewaan.');
            }
        }

        $status->status = $request->status;
        $status->update();

        if ($request->status == 'batal') {
            return redirect()->route('penyewaan.index')
                ->with('success', 'Penyewaan dibatalkan');
        }

        if ($request->status == 'selesai') {
            return redirect()->route('penyewaan.berjalan')
                ->with('success', 'Penyewaan selesai');
        }

        return redirect()->route('penyewaan.index')
            ->with('success', 'Status penyewaan berhasil diperbarui');
    }
}
