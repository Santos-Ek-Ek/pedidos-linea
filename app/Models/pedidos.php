<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pedidos extends Model
{
    protected $table = 'pedidos'; // Explícitamente definir el nombre de tabla

    protected $fillable = [
        'direccion',
        'horario_entrega',
        'cliente_id',
        'producto_id',
        'notas',
        'total',
        'horario_entrega',
        'metodo_entrega',
        'metodo_pago',
        'estado',
        'cantidad',
        'ticket_path',
        'comprobante_paypal'
    ];
    
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }
}