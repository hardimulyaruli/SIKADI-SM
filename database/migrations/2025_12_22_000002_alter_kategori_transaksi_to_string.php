<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah kolom kategori dari ENUM ke VARCHAR agar bisa menampung kategori dinamis (mis. Gas LPG)
        DB::statement("ALTER TABLE transaksi MODIFY kategori VARCHAR(100) NULL");
    }

    public function down(): void
    {
        // Kembali ke ENUM bawaan awal (sesuaikan jika perlu)
        DB::statement("ALTER TABLE transaksi MODIFY kategori ENUM('nastar','kue bulan','pia','bahan','operasional','lain-lain') NULL");
    }
};
