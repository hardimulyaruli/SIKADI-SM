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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();

            // pemasukan / pengeluaran
            $table->enum('tipe', ['pemasukan', 'pengeluaran']);

            // nastar, kue bulan, pia
            $table->enum('kategori', ['nastar', 'kue bulan', 'pia'])->nullable();

            // jumlah barang
            $table->integer('qty')->default(0);

            // total nominal (qty × harga kategori)
            $table->bigInteger('nominal')->default(0);

            // tanggal transaksi
            $table->date('tanggal');

            // deskripsi tambahan (opsional)
            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
