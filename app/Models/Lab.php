<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    /** @use HasFactory<\Database\Factories\LabFactory> */
    use HasFactory;
    protected $fillable = [
        'nama_lab',
        'kapasitas',
    ];

    public function penggunaanLabs()
    {
        return $this->hasMany(PenggunaanLab::class, 'lab_id');
    }
}
