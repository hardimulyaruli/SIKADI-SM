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
        Schema::create('laporan', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('pengguna_id');
        $table->enum('jenis', ['keuangan', 'distribusi']);
        $table->string('periode');
        $table->string('berkas_path');
        $table->timestamps();

        $table->foreign('pengguna_id')->references('id')->on('pengguna')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
