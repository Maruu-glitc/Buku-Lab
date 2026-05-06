<?php

use App\Http\Controllers\LabController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenggunaanLabController;
use App\Http\Controllers\DaftarAktifController;
use App\Models\Lab;

use App\Models\PenggunaanLab;
use Illuminate\Support\Facades\Route;

# 🌐 PUBLIC (mahasiswa/dosen)
Route::get('/', [PenggunaanLabController::class, 'index']);
Route::post('/penggunaan-lab', [PenggunaanLabController::class, 'store'])->name('penggunaan-lab.store');

# 🔐 AUTH (breeze)
require __DIR__ . '/auth.php';

# 👤 USER LOGIN (profile)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

# 👑 ADMIN ONLY
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.partials.content', [
            'pengunjung' => PenggunaanLab::with('pengunjung')->latest()->get(),
            'totalLabs' => Lab::count(),
            'totalPengguna' => Lab::withCount('penggunaanLabs')->get()->sum('penggunaan_labs_count'),
        ]);
    })->name('dashboard');

    # kalau mau CRUD khusus admin
    Route::get('/penggunaan-lab/admin', [PenggunaanLabController::class, 'adminIndex']);
    Route::get('/daftar-aktif', [DaftarAktifController::class, 'index'])->name('daftar-aktif');
});

Route::get('content', function () {
    return view('admin.partials.content', [
        'totalLabs' => Lab::count(),
        'labs' => Lab::all(),
        'pengunjung' => PenggunaanLab::with('pengunjung')->latest()->get(),
        'totalPengguna' => Lab::withCount('penggunaanLabs')->get()->sum('penggunaan_labs_count'),
    ]);
})->name('admin.content');

//notif route
Route::delete('/notifikasi/{id}', [PenggunaanLabController::class, 'destroyNotif'])->name('notifikasi.destroy');
Route::post('/notifikasi/mark-all-read', [PenggunaanLabController::class, 'markAllRead'])->name('notifikasi.markAllRead');


// API endpoint untuk polling notifikasi real-time
Route::get('/api/notifications', function () {
    $notifikasi = PenggunaanLab::with(['pengunjung', 'lab'])
        ->where('is_read', false)
        ->latest()
        ->get();

    return response()->json([
        'count' => $notifikasi->count(),
        'notifications' => $notifikasi->map(function ($notif) {
            return [
                'id' => $notif->id,
                'pengunjung' => [
                    'nama_lengkap' => $notif->pengunjung->nama_lengkap,
                    'tipe_pengguna' => $notif->pengunjung->tipe_pengguna,
                ],
                'lab' => [
                    'nama_lab' => $notif->lab->nama_lab ?? 'Lab',
                ],
                'created_at' => $notif->created_at->diffForHumans(),
            ];
        })
    ]);
});

# Route Lab
Route::resource('lab', LabController::class);