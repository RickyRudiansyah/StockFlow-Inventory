<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController; // <-- Pastikan baris ini ada!
use Illuminate\Support\Facades\Route;

// 1. Redirect Halaman Awal ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Route Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 3. Group Auth (User yang sudah login)
Route::middleware('auth')->group(function () {

    // --- Profil User ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Kategori ---
    Route::resource('kategori', KategoriController::class);

    // --- LAPORAN & EXPORT PDF (Tambahkan Bagian Ini) ---
    // Halaman Menu Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    // Action Download PDF (Nama route disamakan dengan yang ada di view kamu)
    Route::get('/laporan/stok-pdf', [LaporanController::class, 'stokPdf'])->name('laporan.stok.pdf');
    Route::get('/laporan/transaksi-pdf', [LaporanController::class, 'transaksiPdf'])->name('laporan.transaksi.pdf');
    Route::get('/laporan/ringkasan-pdf', [LaporanController::class, 'ringkasanPdf'])->name('laporan.ringkasan.pdf');
});

// Route User Management (Hanya admin yang boleh akses)
Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::resource('users', UserController::class);
})

require __DIR__.'/auth.php';
