<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelangganModel extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $fillable = [
        'nama',
        'no_hp'
    ];
    public function penyewaan()
    {
        return $this->hasMany(PenyewaanModel::class);
    }
}
