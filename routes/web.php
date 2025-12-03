<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
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

    // --- Supplier ---
    Route::resource('supplier', SupplierController::class)->except(['show']);

    // --- Barang ---
    Route::resource('barang', BarangController::class)->except(['show']);

    // --- Transaksi ---
    Route::resource('transaksi', TransaksiController::class)->only(['index', 'create', 'store', 'show']);

    // --- LAPORAN & EXPORT PDF ---
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/stok-pdf', [LaporanController::class, 'stokPdf'])->name('laporan.stok.pdf');
    Route::get('/laporan/transaksi-pdf', [LaporanController::class, 'transaksiPdf'])->name('laporan.transaksi.pdf');
    Route::get('/laporan/ringkasan-pdf', [LaporanController::class, 'ringkasanPdf'])->name('laporan.ringkasan.pdf');

    // --- ADMIN ONLY: Kelola User ---
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });
});

require __DIR__.'/auth.php';
