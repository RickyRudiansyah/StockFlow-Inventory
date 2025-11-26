<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - StockFlow Inventory System
|--------------------------------------------------------------------------
*/

// 1. Redirect halaman awal ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Dashboard - Semua user yang sudah login bisa akses
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 3. Routes untuk semua user yang sudah login (Admin & Staff)
Route::middleware(['auth'])->group(function () {
    
    // --- Profil User ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Kategori (Lihat saja untuk Staff) ---
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');

    // --- Supplier (Lihat saja untuk Staff) ---
    // Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
    // Route::get('/supplier/{supplier}', [SupplierController::class, 'show'])->name('supplier.show');

    // --- Barang (Semua user bisa lihat) ---
    // Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    // Route::get('/barang/{barang}', [BarangController::class, 'show'])->name('barang.show');

    // --- Transaksi (Staff bisa input transaksi) ---
    // Route::resource('transaksi', TransaksiController::class)->except(['destroy']);
});

// 4. Routes khusus Admin saja
Route::middleware(['auth', 'role:admin'])->group(function () {
    
    // --- Kategori (CRUD penuh) ---
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // --- Supplier (CRUD penuh) ---
    // Route::resource('supplier', SupplierController::class)->except(['index', 'show']);

    // --- Barang (CRUD penuh) ---
    // Route::resource('barang', BarangController::class)->except(['index', 'show']);

    // --- Transaksi (Admin bisa hapus) ---
    // Route::delete('/transaksi/{transaksi}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');

    // --- User Management (Hanya Admin) ---
    // Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
