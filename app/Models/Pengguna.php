<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Authenticatable
{
    protected $table = 'pengguna';

    protected $fillable = [
        'nama', 'email', 'kata_sandi', 'peran'
    ];

    public function gaji() { return $this->hasMany(Gaji::class); }
    public function pinjaman() { return $this->hasMany(Pinjaman::class); }
    public function transaksi() { return $this->hasMany(Transaksi::class); }
    public function distribusi() { return $this->hasMany(Distribusi::class); }
    public function laporan() { return $this->hasMany(Laporan::class); }
}
