<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth; // Tambahkan ini biar Editor senang
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Halaman utama laporan (pilih jenis laporan)
     */
    public function index(): View
    {
        return view('laporan.index');
    }

    /**
     * Export Laporan Stok Barang ke PDF
     */
    public function stokPdf(Request $request)
    {
        // --- LOGIC ---
        $query = Barang::with(['kategori', 'supplier']);

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('stok_menipis') && $request->stok_menipis == '1') {
            $query->whereColumn('stok', '<=', 'stok_minimum');
        }

        $barangs = $query->orderBy('nama_barang')->get();

        $summary = [
            'total_items' => $barangs->count(),
            'total_nilai_beli' => $barangs->sum(fn($b) => $b->stok * $b->harga_beli),
            'total_nilai_jual' => $barangs->sum(fn($b) => $b->stok * $b->harga_jual),
            'stok_menipis' => $barangs->filter(fn($b) => $b->stok <= $b->stok_minimum)->count(),
        ];

        // PERBAIKAN: Ambil nama user di luar array agar tidak merah
        $namaUser = Auth::check() ? Auth::user()->name : 'Administrator';

        $data = [
            'title' => __('laporan.stok_barang'),
            'date' => Carbon::now()->translatedFormat('d F Y, H:i'),
            'barangs' => $barangs,
            'summary' => $summary,
            'filter' => [
                'kategori' => $request->kategori_id ? Kategori::find($request->kategori_id)?->nama_kategori : __('laporan.semua'),
                'stok_menipis' => $request->stok_menipis == '1' ? __('laporan.ya') : __('laporan.tidak'),
            ],
            'printed_by' => $namaUser,
        ];

        $pdf = Pdf::loadView('laporan.stok-pdf', $data);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('Laporan_Stok_' . Carbon::now()->format('Y-m-d_His') . '.pdf');
    }

    /**
     * Export Laporan Transaksi ke PDF
     */
    public function transaksiPdf(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'nullable|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        $query = Transaksi::with(['barang', 'user']);

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal_transaksi', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal_transaksi', '<=', $request->tanggal_akhir);
        }

        if ($request->filled('tipe') && in_array($request->tipe, ['masuk', 'keluar'])) {
            $query->where('tipe_transaksi', $request->tipe);
        }

        $transaksis = $query->orderBy('tanggal_transaksi', 'desc')->get();

        $summary = [
            'total_transaksi' => $transaksis->count(),
            'total_masuk' => $transaksis->where('tipe_transaksi', 'masuk')->count(),
            'total_keluar' => $transaksis->where('tipe_transaksi', 'keluar')->count(),
            'nilai_masuk' => $transaksis->where('tipe_transaksi', 'masuk')->sum(fn($t) => $t->jumlah * $t->harga_per_unit),
            'nilai_keluar' => $transaksis->where('tipe_transaksi', 'keluar')->sum(fn($t) => $t->jumlah * $t->harga_per_unit),
        ];

        // PERBAIKAN: Ambil nama user di luar array
        $namaUser = Auth::check() ? Auth::user()->name : 'Administrator';

        $data = [
            'title' => __('laporan.transaksi'),
            'date' => Carbon::now()->translatedFormat('d F Y, H:i'),
            'transaksis' => $transaksis,
            'summary' => $summary,
            'filter' => [
                'periode' => $request->filled('tanggal_mulai')
                    ? Carbon::parse($request->tanggal_mulai)->format('d/m/Y') . ' - ' . Carbon::parse($request->tanggal_akhir)->format('d/m/Y')
                    : __('laporan.semua_periode'),
                'tipe' => $request->tipe ?? __('laporan.semua'),
            ],
            'printed_by' => $namaUser,
        ];

        $pdf = Pdf::loadView('laporan.transaksi-pdf', $data);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan_Transaksi_' . Carbon::now()->format('Y-m-d_His') . '.pdf');
    }

    /**
     * Export Laporan Ringkasan Inventaris ke PDF
     */
    public function ringkasanPdf()
    {
        // PERBAIKAN: Ambil nama user di luar array
        $namaUser = Auth::check() ? Auth::user()->name : 'Administrator';

        $data = [
            'title' => __('laporan.ringkasan_inventaris'),
            'date' => Carbon::now()->translatedFormat('d F Y, H:i'),
            'stats' => [
                'total_barang' => Barang::count(),
                'total_kategori' => Kategori::count(),
                'total_supplier' => Supplier::count(),
                'total_transaksi' => Transaksi::count(),
                'nilai_inventaris' => Barang::all()->sum(fn($b) => $b->stok * $b->harga_beli),
                'potensi_penjualan' => Barang::all()->sum(fn($b) => $b->stok * $b->harga_jual),
            ],
            'stok_menipis' => Barang::with('kategori')
                                ->whereColumn('stok', '<=', 'stok_minimum')
                                ->get(),
            'kategori_chart' => Kategori::withCount('barangs')->get(),
            'transaksi_terbaru' => Transaksi::with(['barang', 'user'])
                                    ->latest('tanggal_transaksi')
                                    ->take(10)
                                    ->get(),
            'printed_by' => $namaUser,
        ];

        $pdf = Pdf::loadView('laporan.ringkasan-pdf', $data);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan_Ringkasan_' . Carbon::now()->format('Y-m-d_His') . '.pdf');
    }
}
