<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User (Admin & Staff)
        $admin = User::create([
            'name' => 'Ricky Admin',
            'email' => 'admin@binus.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $staff = User::create([
            'name' => 'Staff Gudang',
            'email' => 'staff@binus.ac.id',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        // 2. Buat Kategori
        $catElektronik = Kategori::create(['nama_kategori' => 'Elektronik', 'deskripsi' => 'Gadget & IT']);
        $catATK = Kategori::create(['nama_kategori' => 'Alat Tulis', 'deskripsi' => 'Perlengkapan Kantor']);

        // 3. Buat Supplier
        $sup1 = Supplier::create(['nama_supplier' => 'PT. Teknologi Maju', 'no_telepon' => '08123456789']);
        $sup2 = Supplier::create(['nama_supplier' => 'CV. Sumber Kertas', 'no_telepon' => '08111222333']);

        // 4. Buat Barang
        $laptop = Barang::create([
            'nama_barang' => 'Laptop ASUS ROG',
            'sku' => 'ELK-001',
            'kategori_id' => $catElektronik->id,
            'supplier_id' => $sup1->id,
            'harga_beli' => 15000000,
            'harga_jual' => 16500000,
            'satuan' => 'Unit',
            'stok' => 10,
            'stok_minimum' => 2
        ]);

        // 5. Buat Transaksi
        Transaksi::create([
            'user_id' => $admin->id,
            'barang_id' => $laptop->id,
            'tipe_transaksi' => 'masuk',
            'jumlah' => 5,
            'harga_per_unit' => 15000000,
            'tanggal_transaksi' => now()->subDays(10),
            'catatan' => 'Stok Awal'
        ]);
    }
}
