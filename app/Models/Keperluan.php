<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keperluan extends Model
{
    /** @use HasFactory<\Database\Factories\KeperluanFactory> */
    use HasFactory;
    protected $fillable = [
        'nama_keperluan',
    ];

    public function penggunaanLabs()
    {
        return $this->hasMany(PenggunaanLab::class, 'keperluan_id');
    }
}
