<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DaftarPklController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\MitraAdminController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\JadwalPendaftaranController;

// Halaman daftar berita publik (opsional)
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');

// Detail berita publik by id (karena tabel beritas tidak punya kolom slug)
Route::get('/berita/{berita}', [BeritaController::class, 'publicShow'])->name('berita.show');

Route::get('/', function () {
    return view('index');
})->name('index');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Daftar PKL
    Route::get('/daftar-pkl', [DaftarPklController::class, 'index'])->name('daftar-pkl.index');
    Route::post('/daftar-pkl/update-siswa', [DaftarPklController::class, 'updateSiswa'])->name('daftar-pkl.update-siswa');
    Route::get('/daftar-pkl/step-2', [DaftarPklController::class, 'index2'])->name('daftar-pkl.index2');
    Route::post('/daftar-pkl/update-pilihan', [DaftarPklController::class, 'updatePilihan'])->name('daftar-pkl.update-pilihan');
    Route::get('/daftar-pkl/step-3', [DaftarPklController::class, 'index3'])->name('daftar-pkl.index3');
    Route::post('/daftar-pkl/upload-dokumen', [DaftarPklController::class, 'uploadDokumen'])->name('daftar-pkl.upload-dokumen');
    Route::get('/daftar-pkl/step-4', [DaftarPklController::class, 'index4'])->name('daftar-pkl.index4');
    Route::post('/daftar-pkl/submit', [DaftarPklController::class, 'submitPendaftaran'])->name('daftar-pkl.submit');
});

// Mitra (public)
Route::get('/mitra', [MitraController::class, 'index'])->name('mitra.index');
Route::get('/mitra/{id}', [MitraController::class, 'show'])->name('mitra.show');

// Admin
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('dashboard');

    // Pendaftaran PKL (Approval)
    Route::get('/admin/pendaftaran', [RegistrationController::class, 'index'])->name('admin.registrations.index');
    Route::get('/admin/pendaftaran/{registration}', [RegistrationController::class, 'show'])->name('admin.registrations.show');
    Route::post('/admin/pendaftaran/{registration}/approve', [RegistrationController::class, 'approve'])->name('admin.registrations.approve');
    Route::post('/admin/pendaftaran/{registration}/reject', [RegistrationController::class, 'reject'])->name('admin.registrations.reject');
    Route::post('/admin/pendaftaran/{registration}/complete', [RegistrationController::class, 'complete'])->name('admin.registrations.complete');

    // Siswa
    Route::get('/admin/siswa', [SiswaController::class, 'index'])->name('admin.siswa');
    Route::get('/admin/siswa/create', [SiswaController::class, 'create'])->name('admin.siswa.create');
    Route::post('/admin/siswa', [SiswaController::class, 'store'])->name('admin.siswa.store');
    Route::get('/admin/siswa/{siswa}', [SiswaController::class, 'show'])->name('admin.siswa.show');
    Route::get('/admin/siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('admin.siswa.edit');
    Route::put('/admin/siswa/{siswa}', [SiswaController::class, 'update'])->name('admin.siswa.update');
    Route::delete('/admin/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');

    // Jadwal Pendaftaran
    Route::get('/admin/jadwal', [JadwalPendaftaranController::class, 'index'])->name('admin.jadwal.index');
    Route::get('/admin/jadwal/create', [JadwalPendaftaranController::class, 'create'])->name('admin.jadwal.create');
    Route::post('/admin/jadwal', [JadwalPendaftaranController::class, 'store'])->name('admin.jadwal.store');
    Route::get('/admin/jadwal/{jadwal}/edit', [JadwalPendaftaranController::class, 'edit'])->name('admin.jadwal.edit');
    Route::put('/admin/jadwal/{jadwal}', [JadwalPendaftaranController::class, 'update'])->name('admin.jadwal.update');
    Route::post('/admin/jadwal/{jadwal}/toggle', [JadwalPendaftaranController::class, 'toggleActive'])->name('admin.jadwal.toggle');
    Route::delete('/admin/jadwal/{jadwal}', [JadwalPendaftaranController::class, 'destroy'])->name('admin.jadwal.destroy');

        // ===== BERITA (pakai controller) =====
    Route::get   ('/admin/berita',             [BeritaController::class, 'index'])->name('admin.berita');
    Route::get   ('/admin/berita/create',      [BeritaController::class, 'create'])->name('admin.berita.create'); // <- NEW
    Route::post  ('/admin/berita',             [BeritaController::class, 'store'])->name('admin.berita.store');
    Route::get   ('/admin/berita/{berita}',    [BeritaController::class, 'show'])->name('admin.berita.show');     // opsional
    Route::delete('/admin/berita/{berita}',    [BeritaController::class, 'destroy'])->name('admin.berita.destroy');

        // ===== PERUSAHAAN/MITRA (pakai controller) =====
    Route::get   ('/admin/perusahaan',         [MitraAdminController::class, 'index'])->name('admin.perusahaan');
    Route::get   ('/admin/perusahaan/create',  [MitraAdminController::class, 'create'])->name('admin.perusahaan.create');
    Route::post  ('/admin/perusahaan',         [MitraAdminController::class, 'store'])->name('admin.perusahaan.store');
    Route::delete('/admin/perusahaan/{mitra}', [MitraAdminController::class, 'destroy'])->name('admin.perusahaan.destroy');
});

// Auth routes (Breeze/Fortify/Jetstream dsb.)
require __DIR__ . '/auth.php';
