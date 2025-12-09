<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GajiSeeder extends Seeder
{
    public function run()
    {
        DB::table('gaji')->insert([
            [
                'karyawan_id' => 1,
                'jumlah_gaji' => 5000000,
                'tanggal' => '2025-12-01',
                'keterangan' => 'Gaji bulan Desember',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 2,
                'jumlah_gaji' => 4500000,
                'tanggal' => '2025-12-01',
                'keterangan' => 'Gaji bulan Desember',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 3,
                'jumlah_gaji' => 4000000,
                'tanggal' => '2025-12-01',
                'keterangan' => 'Gaji bulan Desember',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
