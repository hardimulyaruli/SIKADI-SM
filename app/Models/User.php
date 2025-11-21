<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'nama',
        'email',
        'kata_sandi',
        'peran',
    ];

    // Override agar Laravel tahu password pakai 'kata_sandi'
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}
