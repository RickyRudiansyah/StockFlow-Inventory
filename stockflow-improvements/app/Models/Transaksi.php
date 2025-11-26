<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'barang_id',
        'tipe_transaksi',
        'jumlah',
        'harga_per_unit',
        'tanggal_transaksi',
        'catatan',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'date',
        'harga_per_unit' => 'decimal:2',
    ];

    /**
     * Boot method untuk Eloquent Events
     * Auto-update stok saat transaksi dibuat/dihapus
     */
    protected static function booted()
    {
        // Saat transaksi DIBUAT -> update stok
        static::created(function ($transaksi) {
            $transaksi->updateStok('create');
        });

        // Saat transaksi DIHAPUS -> rollback stok
        static::deleting(function ($transaksi) {
            $transaksi->updateStok('delete');
        });
    }

    /**
     * Logic untuk update stok barang
     */
    protected function updateStok(string $action): void
    {
        $barang = $this->barang;
        
        if (!$barang) {
            return;
        }

        if ($action === 'create') {
            // Transaksi baru dibuat
            if ($this->tipe_transaksi === 'masuk') {
                $barang->increment('stok', $this->jumlah);
            } else {
                $barang->decrement('stok', $this->jumlah);
            }
        } elseif ($action === 'delete') {
            // Transaksi dihapus -> rollback
            if ($this->tipe_transaksi === 'masuk') {
                $barang->decrement('stok', $this->jumlah);
            } else {
                $barang->increment('stok', $this->jumlah);
            }
        }
    }

    /**
     * Hitung total nilai transaksi
     */
    public function getTotalNilaiAttribute(): float
    {
        return $this->jumlah * $this->harga_per_unit;
    }

    // ==================== RELASI ====================

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
