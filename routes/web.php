<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController; // <-- Pastikan baris ini ada!
use Illuminate\Support\Facades\Route;


// 1. Redirect Halaman Awal ke Login
// Jadi kalau buka http://stockflow.test, langsung masuk form login
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Route Dashboard
// Menggunakan DashboardController yang ada grafiknya
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 3. Group Auth (Hanya bisa diakses kalau sudah login)
Route::middleware('auth')->group(function () {

    // --- Route untuk Fitur Kategori ---
    // Ini yang menyambungkan menu Kategori ke Controller-nya
    Route::resource('kategori', KategoriController::class);
    // ----------------------------------

    // Fitur Profile Bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
