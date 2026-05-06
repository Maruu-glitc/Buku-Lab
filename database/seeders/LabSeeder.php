<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert default lab data
        \App\Models\Lab::insert([
            ['nama_lab' => 'Lab Komputer 1', 'kapasitas' => 20],
            ['nama_lab' => 'Lab Komputer 2', 'kapasitas' => 20],
            ['nama_lab' => 'Lab Komputer 3', 'kapasitas' => 20],
            ['nama_lab' => 'Lab Multimedia', 'kapasitas' => 20],
        ]);
    }
}
