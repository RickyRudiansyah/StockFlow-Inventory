<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // 1. Tampilkan Daftar Kategori (Read)
    public function index()
    {
        // Ambil semua data kategori dari database
        $kategoris = Kategori::all();

        // Kirim data ke tampilan (View)
        return view('kategori.index', compact('kategoris'));
    }

    // 2. Tampilkan Form Tambah (Create)
    public function create()
    {
        return view('kategori.create');
    }

    // 3. Simpan Data Baru (Store)
    public function store(Request $request)
    {
        // Validasi Input (Wajib ada namanya)
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Simpan ke Database
        Kategori::create($request->all());

        // Kembali ke daftar dengan pesan sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // 4. Tampilkan Form Edit
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    // 5. Update Data
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // 6. Hapus Data
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
