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
        Schema::create('pinjaman', function (Blueprint $table) {
        $table->id('pinjaman_id');
        $table->unsignedBigInteger('karyawan_id');
        $table->integer('jumlah_pinjaman');
        $table->date('tanggal');
        $table->enum('status', ['belum_lunas', 'lunas']);
        $table->text('keterangan')->nullable();
        $table->timestamps();

        $table->foreign('karyawan_id')->references('id')->on('karyawans')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjaman');
    }
};
