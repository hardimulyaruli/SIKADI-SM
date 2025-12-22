<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Normalisasi data jabatan yang tidak sesuai daftar enum agar migrasi tidak gagal
        DB::statement("UPDATE karyawans SET jabatan = 'lainnya' WHERE jabatan IS NOT NULL AND jabatan NOT IN ('produksi','distribusi','keuangan','admin','marketing','lainnya')");

        // Ubah kolom jabatan menjadi ENUM dengan daftar tetap
        DB::statement("ALTER TABLE karyawans MODIFY jabatan ENUM('produksi','distribusi','keuangan','admin','marketing','lainnya') NULL");
    }

    public function down(): void
    {
        // Kembalikan ke VARCHAR jika rollback
        DB::statement("ALTER TABLE karyawans MODIFY jabatan VARCHAR(255) NULL");
    }
};
