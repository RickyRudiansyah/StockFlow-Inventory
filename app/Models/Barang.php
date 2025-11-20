<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'sku',
        'kategori_id',
        'supplier_id',
        'harga_beli',
        'harga_jual',
        'satuan',
        'stok',
        'stok_minimum',
    ];

    // Relasi: Barang milik satu Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Relasi: Barang milik satu Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relasi: Barang punya banyak riwayat Transaksi
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
