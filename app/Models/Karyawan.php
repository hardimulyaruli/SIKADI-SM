<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawans';

    protected $fillable = [
        'nama', 'jabatan', 'no_hp', 'alamat'
    ];

    public function gaji()
    {
        return $this->hasMany(Gaji::class, 'karyawan_id');
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'karyawan_id');
    }
}
