<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'barang_id',
        'tipe_transaksi', // 'masuk' atau 'keluar'
        'jumlah',
        'harga_per_unit', // Harga saat transaksi terjadi
        'tanggal_transaksi',
        'catatan',
    ];

    // Casting tanggal agar otomatis jadi objek Carbon (mudah diformat tgl-bln-thn)
    protected $casts = [
        'tanggal_transaksi' => 'date',
    ];

    // Relasi: Transaksi milik satu Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // Relasi: Transaksi dicatat oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
