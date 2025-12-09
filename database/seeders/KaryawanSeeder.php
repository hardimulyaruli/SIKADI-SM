<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        DB::table('karyawans')->insert([
            [
                'nama' => 'Ahmad Sujadi',
                'jabatan' => 'Staff',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Mawar No. 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'jabatan' => 'Manager',
                'no_hp' => '081298765432',
                'alamat' => 'Jl. Melati No. 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Budi Santoso',
                'jabatan' => 'Supervisor',
                'no_hp' => '081212345678',
                'alamat' => 'Jl. Kenanga No. 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
