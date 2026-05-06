<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\PenggunaanLab;

class DaftarAktifController extends Controller
{
    public function index()
    {
        $query = PenggunaanLab::with(['pengunjung', 'lab', 'keperluan'])
            ->whereNull('jam_keluar');

        // 🔥 FILTER SORT
        if (request('sort') == 'terlama') {
            $query->orderBy('tanggal', 'asc')
                ->orderBy('jam_masuk', 'asc');
        } else {
            // default terbaru
            $query->orderBy('tanggal', 'desc')
                ->orderBy('jam_masuk', 'desc');
        }

        $penggunaanLabs = $query->get();
        $labs = Lab::all();

        return view('admin.nav.daftar-aktif', compact('penggunaanLabs', 'labs'));
    }
}