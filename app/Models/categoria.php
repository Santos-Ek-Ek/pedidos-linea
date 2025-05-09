<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'activo',
    ];

    public function productos()
    {
        return $this->hasMany(producto::class);
    }
}
