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
        $table->id();
        $table->unsignedBigInteger('pengguna_id');
        $table->integer('jumlah_gaji');
        $table->date('tanggal');
        $table->text('keterangan')->nullable();
        $table->timestamps();

        $table->foreign('pengguna_id')->references('id')->on('pengguna')->onDelete('cascade');
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
