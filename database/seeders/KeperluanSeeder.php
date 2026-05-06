<?php

namespace Database\Seeders;

use App\Models\Keperluan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeperluanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Keperluan::insert([
            ['nama_keperluan' => 'Praktikum'],
            ['nama_keperluan' => 'Penelitian'],
            ['nama_keperluan' => 'Tugas'],
            ['nama_keperluan' => 'Lainnya'],
        ]);
    }
}
