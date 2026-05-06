<?php

namespace App\Http\Controllers;

use App\Models\PenggunaanLab;
use App\Models\Lab;
use App\Http\Requests\StorePenggunaanLabRequest;
use App\Http\Requests\UpdatePenggunaanLabRequest;
use Illuminate\Http\Request;
use App\Models\Pengunjung;
use App\Models\Keperluan;

class PenggunaanLabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function markAllRead()
    {
        PenggunaanLab::where('is_read', false)->update(['is_read' => true]);
        return back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }

    public function destroyNotif($id)
    {
        $notif = PenggunaanLab::findOrFail($id);
        $notif->update(['is_read' => true]);

        return back()->with('success', 'Notifikasi berhasil dihapus.');
    }

    public function index()
    {

        $penggunaanLabs = PenggunaanLab::all();
        $lab = Lab::withCount([
            'penggunaanLabs as aktif_count' => function ($query) {
                $query->whereNull('jam_keluar');
            }
        ])->get();
        $keperluan = Keperluan::all();
        return view('home', compact('penggunaanLabs', 'lab', 'keperluan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'nullable|numeric|digits_between:8,15',
            'nama' => 'required|string|max:100',
            'tipe_pengguna' => 'required|in:mahasiswa,dosen,pegawai',
            'prodi' => 'required|string|max:100',
            'lab_id' => 'required|exists:labs,id',
            'keperluan_id' => 'required|exists:keperluans,id',
            'keterangan' => 'nullable|string|max:255',
        ], [
            'nim.numeric' => 'NIM harus berupa angka.',
            'nim.digits_between' => 'NIM harus memiliki 8-15 digit.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'tipe_pengguna.required' => 'Tipe pengguna wajib dipilih.',
            'prodi.required' => 'Program studi wajib diisi.',
            'lab_id.required' => 'Lab wajib dipilih.',
            'lab_id.exists' => 'Lab tidak valid.',
            'keperluan_id.required' => 'Keperluan wajib dipilih.',
        ]);

        $pengunjung = Pengunjung::firstOrCreate(
            ['nim' => $request->nim],
            [
                'nama_lengkap' => $request->nama,
                'tipe_pengguna' => $request->tipe_pengguna,
                'prodi' => $request->prodi,
            ]
        );

        $penggunaanLab = PenggunaanLab::create([
            'pengunjung_id' => $pengunjung->id,
            'lab_id' => $request->lab_id,
            'keperluan_id' => $request->keperluan_id,
            'tanggal' => now()->toDateString(),
            'jam_masuk' => now(),
            'jam_keluar' => null,
        ]);

        return back()->with('success', 'Selamat Datang Di Lab ' . $pengunjung->nama_lengkap);
    }

    /**
     * Display the specified resource.
     */
    public function show(PenggunaanLab $penggunaanLab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenggunaanLab $penggunaanLab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePenggunaanLabRequest $request, PenggunaanLab $penggunaanLab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenggunaanLab $penggunaanLab)
    {
        //
    }
}
