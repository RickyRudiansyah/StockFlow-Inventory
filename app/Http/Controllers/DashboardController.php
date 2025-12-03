<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Data Statistik Utama
        $totalBarang = Barang::count();
        $totalKategori = Kategori::count();
        $totalSupplier = Supplier::count();

        // Stok Management - SESUAI dengan field di model Barang
        $barangMenipis = Barang::where('stok', '<', DB::raw('stok_minimum'))
            ->where('stok', '>', 0)
            ->with('kategori')
            ->get();
        $barangHabis = Barang::where('stok', 0)->count();

        // Data Finansial
        $totalNilaiAset = Barang::sum(DB::raw('stok * harga_beli'));
        $potensiProfit = Barang::sum(DB::raw('stok * (harga_jual - harga_beli)'));

        // Data untuk Charts - SESUAI dengan method barangs() di model Kategori
        $chartData = Kategori::withCount('barangs')->get();
        $chartLabels = $chartData->pluck('nama_kategori');
        $chartValues = $chartData->pluck('barangs_count');

        // Data Tambahan
        $transaksiTerbaru = Transaksi::with(['barang', 'user'])
            ->latest()
            ->take(8)
            ->get();

        $stokTerbanyak = Barang::with('kategori')
            ->orderBy('stok', 'desc')
            ->take(5)
            ->get();

        $stokTerendah = Barang::with('kategori')
            ->where('stok', '>', 0)
            ->orderBy('stok', 'asc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalKategori',
            'totalSupplier',
            'barangMenipis',
            'barangHabis',
            'totalNilaiAset',
            'potensiProfit',
            'chartLabels',
            'chartValues',
            'transaksiTerbaru',
            'stokTerbanyak',
            'stokTerendah'
        ));
    }
}
