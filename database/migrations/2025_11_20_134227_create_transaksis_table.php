<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');

        // Detail Transaksi
        $table->enum('tipe_transaksi', ['masuk', 'keluar']);
        $table->integer('jumlah');
        $table->decimal('harga_per_unit', 15, 2)->default(0); // Harga saat kejadian
        $table->date('tanggal_transaksi'); // Pakai date saja biar simpel di input
        $table->text('catatan')->nullable();

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
