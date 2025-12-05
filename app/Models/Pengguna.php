<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'nama', 'email', 'kata_sandi', 'peran'
    ];

    protected $hidden = [
        'kata_sandi',
    ];

    public function getAuthPassword()
    {
        return $this->kata_sandi; // karena nama kolom password Anda "kata_sandi"
    }

    public function gaji() { return $this->hasMany(Gaji::class); }
    public function pinjaman() { return $this->hasMany(Pinjaman::class); }
    public function transaksi() { return $this->hasMany(Transaksi::class); }
    public function distribusi() { return $this->hasMany(Distribusi::class); }
    public function laporan() { return $this->hasMany(Laporan::class); }
}
