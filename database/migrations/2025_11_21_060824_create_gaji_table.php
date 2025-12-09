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
        schema::dropIfExists('gaji');
        Schema::create('gaji', function (Blueprint $table) {
<<<<<<< HEAD
        $table->id('gaji_id');
=======
        $table->id();
>>>>>>> bbcbe1d870ff0c3fade549d9fe390846061406b0
        $table->unsignedBigInteger('karyawan_id');
        $table->integer('jumlah_gaji');
        $table->date('tanggal');
        $table->text('keterangan')->nullable();
        $table->timestamps();

<<<<<<< HEAD
        $table->foreign('karyawan_id')->references('karyawan_id')->on('karyawan')->onDelete('cascade');
=======
        $table->foreign('karyawan_id')->references('id')->on('karyawans')->onDelete('cascade');
>>>>>>> bbcbe1d870ff0c3fade549d9fe390846061406b0
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
