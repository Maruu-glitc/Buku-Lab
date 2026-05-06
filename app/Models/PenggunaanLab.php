<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaanLab extends Model
{
    /** @use HasFactory<\Database\Factories\PenggunaanLabFactory> */
    use HasFactory;
    protected $fillable = [
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'is_read',
        'lab_id',
        'pengunjung_id',
        'keperluan_id',
    ];

    public function pengunjung()
    {
        return $this->belongsTo(Pengunjung::class, 'pengunjung_id');
    }

    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }

    public function keperluan()
    {
        return $this->belongsTo(Keperluan::class, 'keperluan_id');
    }
}
