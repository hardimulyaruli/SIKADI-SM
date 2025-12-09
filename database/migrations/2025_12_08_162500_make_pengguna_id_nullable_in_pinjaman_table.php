<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
<<<<<<< HEAD:database/migrations/2025_12_07_080535_karyawan.php
         Schema::create('karyawan', function (Blueprint $table) {
        $table->id('karyawan_id');
        $table->string('nama');
        $table->string('jabatan')->nullable();
        $table->string('no_hp')->nullable();
        $table->string('alamat')->nullable();
        $table->timestamps();
    });
    }
  
=======
        Schema::table('pinjaman', function (Blueprint $table) {
            $table->unsignedBigInteger('pengguna_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
>>>>>>> bbcbe1d870ff0c3fade549d9fe390846061406b0:database/migrations/2025_12_08_162500_make_pengguna_id_nullable_in_pinjaman_table.php
    public function down(): void
    {
        Schema::table('pinjaman', function (Blueprint $table) {
            $table->unsignedBigInteger('pengguna_id')->nullable(false)->change();
        });
    }
};
