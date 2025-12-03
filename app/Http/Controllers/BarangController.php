<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar semua barang
     */
    public function index(Request $request)
    {
        $query = Barang::with(['kategori', 'supplier']);

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Filter berdasarkan supplier
        if ($request->filled('supplier')) {
            $query->where('supplier_id', $request->supplier);
        }

        // Filter berdasarkan status stok
        if ($request->filled('status')) {
            switch ($request->status) {
                case 'habis':
                    $query->where('stok', 0);
                    break;
                case 'menipis':
                    $query->where('stok', '>', 0)
                          ->whereColumn('stok', '<=', 'stok_minimum');
                    break;
                case 'aman':
                    $query->whereColumn('stok', '>', 'stok_minimum');
                    break;
            }
        }

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('kode_barang', 'like', "%{$search}%");
            });
        }

        $barangs = $query->latest()->get();

        // Data untuk filter dropdown
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $suppliers = Supplier::orderBy('nama_supplier')->get();

        return view('barang.index', compact('barangs', 'kategoris', 'suppliers'));
    }

    /**
     * Menampilkan form tambah barang
     */
    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $suppliers = Supplier::orderBy('nama_supplier')->get();

        // Generate kode barang otomatis
        $lastBarang = Barang::latest('id')->first();
        $nextNumber = $lastBarang ? $lastBarang->id + 1 : 1;
        $kodeBarang = 'BRG-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        return view('barang.create', compact('kategoris', 'suppliers', 'kodeBarang'));
    }

    /**
     * Menyimpan barang baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'nullable|string|max:50|unique:barangs,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0|gte:harga_beli',
            'stok' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string|max:1000',
            'lokasi_penyimpanan' => 'nullable|string|max:255',
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.max' => 'Nama barang maksimal 255 karakter.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori tidak valid.',
            'supplier_id.required' => 'Supplier wajib dipilih.',
            'supplier_id.exists' => 'Supplier tidak valid.',
            'harga_beli.required' => 'Harga beli wajib diisi.',
            'harga_beli.min' => 'Harga beli tidak boleh negatif.',
            'harga_jual.required' => 'Harga jual wajib diisi.',
            'harga_jual.min' => 'Harga jual tidak boleh negatif.',
            'harga_jual.gte' => 'Harga jual harus lebih besar atau sama dengan harga beli.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.min' => 'Stok tidak boleh negatif.',
            'stok_minimum.required' => 'Stok minimum wajib diisi.',
            'stok_minimum.min' => 'Stok minimum tidak boleh negatif.',
            'satuan.required' => 'Satuan wajib diisi.',
            'kode_barang.unique' => 'Kode barang sudah digunakan.',
        ]);

        // Generate kode barang jika kosong
        if (empty($validated['kode_barang'])) {
            $lastBarang = Barang::latest('id')->first();
            $nextNumber = $lastBarang ? $lastBarang->id + 1 : 1;
            $validated['kode_barang'] = 'BRG-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        }

        Barang::create($validated);

        return redirect()->route('barang.index')
            ->with('success', 'Barang "' . $validated['nama_barang'] . '" berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail barang
     */
    public function show(Barang $barang)
    {
        $barang->load(['kategori', 'supplier', 'transaksis' => function ($query) {
            $query->with('user')->latest()->take(10);
        }]);

        return view('barang.show', compact('barang'));
    }

    /**
     * Menampilkan form edit barang
     */
    public function edit(Barang $barang)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $suppliers = Supplier::orderBy('nama_supplier')->get();

        return view('barang.edit', compact('barang', 'kategoris', 'suppliers'));
    }

    /**
     * Mengupdate data barang
     */
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'kode_barang' => 'nullable|string|max:50|unique:barangs,kode_barang,' . $barang->id,
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0|gte:harga_beli',
            'stok' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string|max:1000',
            'lokasi_penyimpanan' => 'nullable|string|max:255',
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori tidak valid.',
            'supplier_id.required' => 'Supplier wajib dipilih.',
            'supplier_id.exists' => 'Supplier tidak valid.',
            'harga_beli.required' => 'Harga beli wajib diisi.',
            'harga_beli.min' => 'Harga beli tidak boleh negatif.',
            'harga_jual.required' => 'Harga jual wajib diisi.',
            'harga_jual.gte' => 'Harga jual harus lebih besar atau sama dengan harga beli.',
            'stok.required' => 'Stok wajib diisi.',
            'stok_minimum.required' => 'Stok minimum wajib diisi.',
            'satuan.required' => 'Satuan wajib diisi.',
            'kode_barang.unique' => 'Kode barang sudah digunakan.',
        ]);

        $barang->update($validated);

        return redirect()->route('barang.index')
            ->with('success', 'Barang "' . $barang->nama_barang . '" berhasil diperbarui.');
    }

    /**
     * Menghapus barang dari database
     */
    public function destroy(Barang $barang)
    {
        // Cek apakah barang sudah memiliki transaksi
        if ($barang->transaksis()->count() > 0) {
            return redirect()->route('barang.index')
                ->with('error', 'Barang "' . $barang->nama_barang . '" tidak dapat dihapus karena sudah memiliki ' . $barang->transaksis()->count() . ' riwayat transaksi.');
        }

        $namaBarang = $barang->nama_barang;
        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang "' . $namaBarang . '" berhasil dihapus.');
    }

    /**
     * Export data barang (opsional)
     */
    public function export(Request $request)
    {
        $barangs = Barang::with(['kategori', 'supplier'])->get();

        // Logic untuk export ke Excel/CSV bisa ditambahkan di sini

        return response()->json($barangs);
    }
}
