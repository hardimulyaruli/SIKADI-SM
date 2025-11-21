<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('pengguna')->insert([
            [
                'nama' => 'Owner SIKADI',
                'email' => 'owner@sikadi.com',
                'kata_sandi' => Hash::make('password'),
                'peran' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Keuangan SIKADI',
                'email' => 'keuangan@sikadi.com',
                'kata_sandi' => Hash::make('password'),
                'peran' => 'keuangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Distribusi SIKADI',
                'email' => 'distribusi@sikadi.com',
                'kata_sandi' => Hash::make('password'),
                'peran' => 'distribusi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
