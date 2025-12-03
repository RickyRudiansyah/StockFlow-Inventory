<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['barang', 'user'])->latest()->paginate(20);
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $barangs = Barang::orderBy('nama_barang')->get();
        return view('transaksi.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tipe' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:500',
        ], [
            'barang_id.required' => 'Barang wajib dipilih.',
            'barang_id.exists' => 'Barang tidak valid.',
            'tipe.required' => 'Tipe transaksi wajib dipilih.',
            'tipe.in' => 'Tipe transaksi tidak valid.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.min' => 'Jumlah minimal 1.',
        ]);

        $barang = Barang::findOrFail($validated['barang_id']);

        // Validasi stok untuk transaksi keluar
        if ($validated['tipe'] === 'keluar' && $barang->stok < $validated['jumlah']) {
            return back()->withErrors([
                'jumlah' => 'Stok tidak mencukupi. Stok tersedia: ' . $barang->stok . ' ' . $barang->satuan
            ])->withInput();
        }

        DB::transaction(function () use ($validated, $barang) {
            // Update stok barang
            if ($validated['tipe'] === 'masuk') {
                $barang->increment('stok', $validated['jumlah']);
            } else {
                $barang->decrement('stok', $validated['jumlah']);
            }

            // Simpan transaksi
            Transaksi::create([
                'barang_id' => $validated['barang_id'],
                'user_id' => Auth::id(),
                'tipe' => $validated['tipe'],
                'jumlah' => $validated['jumlah'],
                'keterangan' => $validated['keterangan'],
            ]);
        });

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dicatat.');
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['barang', 'user']);
        return view('transaksi.show', compact('transaksi'));
    }
}
