<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyewaanModel extends Model
{
    use HasFactory;

    protected $table = 'penyewaan';

    protected $fillable = [
        'user_id',
        'lapangan_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'total_harga',
        'bukti_id',
        'status'
    ];

    // Relasi ke lapangan
    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }

    // Relasi ke pelanggan

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
