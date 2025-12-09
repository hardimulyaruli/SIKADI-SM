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
        Schema::create('gaji', function (Blueprint $table) {
        $table->id('gaji_id');
        $table->unsignedBigInteger('karyawan_id');
        $table->integer('jumlah_gaji');
        $table->date('tanggal');
        $table->text('keterangan')->nullable();
        $table->timestamps();

        $table->foreign('karyawan_id')->references('karyawan_id')->on('karyawan')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};
