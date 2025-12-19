<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
         Schema::create('karyawan', function (Blueprint $table) {
        $table->id('karyawan_id');
        $table->string('nama');
        $table->string('jabatan')->nullable();
        $table->string('no_hp')->nullable();
        $table->string('alamat')->nullable();
        $table->timestamps();
    });
    }
  
    public function down(): void
    {
        Schema::table('pinjaman', function (Blueprint $table) {
            $table->unsignedBigInteger('pengguna_id')->nullable(false)->change();
        });
    }
};
