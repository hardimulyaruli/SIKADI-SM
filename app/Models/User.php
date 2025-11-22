<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'pengguna'; // pakai tabel pengguna

    protected $fillable = [
        'nama',
        'email',
        'kata_sandi',
        'peran',
    ];

    protected $hidden = [
        'kata_sandi',
    ];

    // Mapping agar Auth memakai kolom kata_sandi
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}