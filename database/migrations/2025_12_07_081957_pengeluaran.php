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
         Schema::create('pengeluarans', function (Blueprint $table) {
        $table->id('pengeluaran_id');
        $table->unsignedBigInteger('user_id');
        $table->decimal('jumlah', 12, 2);
        $table->date('tanggal_pengeluaran');
        $table->string('keperluan')->nullable();
        $table->text('keterangan')->nullable();
        $table->timestamps();

        $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
