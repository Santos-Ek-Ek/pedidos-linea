<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\pedidos;
use App\Models\User;
use App\Models\Producto;

class comprasController extends Controller
{
    public function misPedidos()
    {
        // Verificar que el usuario esté autenticado
        if (!Auth::check()) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Realizar la consulta
        $pedidos = pedidos::select('pedidos.*', 'users.name', 'users.lastname', 'users.telefono', 'productos.nombre as producto_nombre', 'productos.imagen as producto_imagen')
            ->join('users', 'pedidos.cliente_id', '=', 'users.id')
            ->join('productos', 'productos.id', '=', 'pedidos.producto_id')
            ->where('users.id', $userId)
            ->get();

        return view('contenido.misCompras', compact('pedidos'));
    }
}
