<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_supplier',
        'no_telepon',
        'email',
        'alamat',
    ];

    // Relasi: Satu Supplier menyuplai banyak Barang
    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
