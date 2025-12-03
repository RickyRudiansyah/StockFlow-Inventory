<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Menampilkan daftar semua supplier
     */
    public function index()
    {
        $suppliers = Supplier::withCount('barangs')->latest()->get();
        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Menampilkan form tambah supplier
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Menyimpan supplier baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_supplier' => 'required|string|max:255|unique:suppliers,nama_supplier',
            'alamat' => 'nullable|string|max:500',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:suppliers,email',
            'kontak_person' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:1000',
        ], [
            'nama_supplier.required' => 'Nama supplier wajib diisi.',
            'nama_supplier.unique' => 'Nama supplier sudah terdaftar.',
            'nama_supplier.max' => 'Nama supplier maksimal 255 karakter.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan supplier lain.',
            'telepon.max' => 'Nomor telepon maksimal 20 karakter.',
        ]);

        Supplier::create($validated);

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier "' . $validated['nama_supplier'] . '" berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail supplier (opsional)
     */
    public function show(Supplier $supplier)
    {
        $supplier->load(['barangs' => function ($query) {
            $query->with('kategori')->latest()->take(10);
        }]);

        return view('supplier.show', compact('supplier'));
    }

    /**
     * Menampilkan form edit supplier
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Mengupdate data supplier
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'nama_supplier' => 'required|string|max:255|unique:suppliers,nama_supplier,' . $supplier->id,
            'alamat' => 'nullable|string|max:500',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:suppliers,email,' . $supplier->id,
            'kontak_person' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:1000',
        ], [
            'nama_supplier.required' => 'Nama supplier wajib diisi.',
            'nama_supplier.unique' => 'Nama supplier sudah terdaftar.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan supplier lain.',
        ]);

        $supplier->update($validated);

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier "' . $supplier->nama_supplier . '" berhasil diperbarui.');
    }

    /**
     * Menghapus supplier dari database
     */
    public function destroy(Supplier $supplier)
    {
        // Cek apakah supplier masih memiliki barang terkait
        if ($supplier->barangs()->count() > 0) {
            return redirect()->route('supplier.index')
                ->with('error', 'Supplier "' . $supplier->nama_supplier . '" tidak dapat dihapus karena masih memiliki ' . $supplier->barangs()->count() . ' barang terkait.');
        }

        $namaSupplier = $supplier->nama_supplier;
        $supplier->delete();

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier "' . $namaSupplier . '" berhasil dihapus.');
    }
}
