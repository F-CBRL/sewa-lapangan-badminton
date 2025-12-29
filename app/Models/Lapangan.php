<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    protected $table = 'lapangans';

    protected $fillable = [
        'nama_lapangan',
        'img',
        'harga_per_jam',
        'status',
        'keterangan'
    ];

    public function penyewaan()
    {
        return $this->hasMany(PenyewaanModel::class);
    }
}
