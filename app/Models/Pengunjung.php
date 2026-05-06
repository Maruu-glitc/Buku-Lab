<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    /** @use HasFactory<\Database\Factories\PengunjungFactory> */
    use HasFactory;
    protected $fillable = [
        'nama_lengkap',
        'tipe_pengguna',
        'nim',
        'prodi',
    ];

    public function penggunaanLabs()
    {
        return $this->hasMany(PenggunaanLab::class, 'pengunjung_id');
    }
}
