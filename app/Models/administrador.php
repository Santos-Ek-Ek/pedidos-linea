<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class administrador extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'admin';

    protected $table = 'administradores';

    protected $fillable = [
        'nombre_completo',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}