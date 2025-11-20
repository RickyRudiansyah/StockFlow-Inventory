<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Card Ringkasan Atas (Statistik Dasar)
        $totalBarang = Barang::count();
        $totalKategori = Kategori::count();
        $totalSupplier = Supplier::count();

        // 2. Card Peringatan (Stok Menipis)
        // Logic: Cari barang yang stoknya <= stok_minimum
        $barangMenipis = Barang::whereColumn('stok', '<=', 'stok_minimum')->get();

        // 3. Data untuk Grafik (Pie Chart)
        // Logic: Hitung jumlah produk di setiap kategori
        // Hasilnya dipisah jadi 2 array: Label (Nama Kategori) dan Values (Jumlahnya)
        $kategoriData = Kategori::withCount('barangs')->get();
        $chartLabels = $kategoriData->pluck('nama_kategori');
        $chartValues = $kategoriData->pluck('barangs_count');

        // 4. Riwayat Transaksi Terakhir (Tabel)
        // Ambil 5 transaksi paling baru, beserta data barang dan user-nya
        $transaksiTerbaru = Transaksi::with(['barang', 'user'])
                            ->latest('tanggal_transaksi')
                            ->take(5)
                            ->get();

        // Kirim semua variabel di atas ke View 'dashboard'
        return view('dashboard', compact(
            'totalBarang',
            'totalKategori',
            'totalSupplier',
            'barangMenipis',
            'chartLabels',
            'chartValues',
            'transaksiTerbaru'
        ));
    }
}
