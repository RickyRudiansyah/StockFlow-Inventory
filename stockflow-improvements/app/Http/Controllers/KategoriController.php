<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KategoriController extends Controller
{
    /**
     * Tampilkan daftar kategori
     */
    public function index(): View
    {
        $kategoris = Kategori::withCount('barangs')
                            ->latest()
                            ->get();

        return view('kategori.index', compact('kategoris'));
    }

    /**
     * Tampilkan form tambah kategori
     */
    public function create(): View
    {
        return view('kategori.create');
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori',
            'deskripsi' => 'nullable|string|max:1000',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah ada, gunakan nama lain.',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter.',
            'deskripsi.max' => 'Deskripsi maksimal 1000 karakter.',
        ]);

        Kategori::create($validated);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail kategori (opsional)
     */
    public function show(Kategori $kategori): View
    {
        $kategori->load('barangs');
        
        return view('kategori.show', compact('kategori'));
    }

    /**
     * Tampilkan form edit kategori
     */
    public function edit(Kategori $kategori): View
    {
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update data kategori
     */
    public function update(Request $request, Kategori $kategori): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $kategori->id,
            'deskripsi' => 'nullable|string|max:1000',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah ada, gunakan nama lain.',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter.',
            'deskripsi.max' => 'Deskripsi maksimal 1000 karakter.',
        ]);

        $kategori->update($validated);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Hapus kategori
     */
    public function destroy(Kategori $kategori): RedirectResponse
    {
        // Cek apakah kategori masih punya barang
        if ($kategori->barangs()->count() > 0) {
            return redirect()
                ->route('kategori.index')
                ->with('error', 'Kategori tidak bisa dihapus karena masih memiliki ' . $kategori->barangs()->count() . ' barang.');
        }

        $kategori->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
