<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'imagen',
        'detalle',
        'categoria_id',
        'precio',
        'activo',
        'disponibles'
    ];
    public function categoria()
    {
        return $this->belongsTo(categoria::class);
    }

    public function pedidos()
{
    return $this->hasMany(pedidos::class);
}
}
