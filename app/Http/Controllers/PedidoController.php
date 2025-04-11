<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pedidos;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function mostrarPedidos(){
        $pedidos = pedidos::all();
        return view ('administrador.pedidos', compact('pedidos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'direccion' => 'required',
            'referencias' => 'nullable',
            'delivery_option' => 'required|in:Pasar a recoger,Enviar a domicilio',
'pickup_time' => 'nullable|required_if:delivery_option,Pasar a recoger', // Corregido el valor
    'delivery_time' => 'nullable|required_if:delivery_option,Enviar a domicilio',
            'productos' => 'required|json'
        ]);
    
        $productos = json_decode($request->productos, true);
        
        // Calcular total general
        $total = collect($productos)->sum(function($producto) {
            return $producto['price'] * $producto['quantity'];
        });
    
        if ($request->delivery_option === 'delivery') {
            $total += 5.00;
        }
    
        // Crear un registro por cada producto en el carrito
        foreach ($productos as $producto) {
            pedidos::create([
                'cliente_id' => Auth::id(),
                'producto_id' => $producto['id'],
                'cantidad' => $producto['quantity'],
                'precio' => $producto['price'],
                'notas' => $producto['nota'] ?? null,
                'direccion' => $request->input('direccion') . ' - ' . $request->input('referencias'),
                'metodo_pago' => $request->input('metodo_pago'),
                'metodo_entrega' => $request->input('delivery_option'),
                'horario_entrega' => $request->input('delivery_option') === 'Pasar a recoger' 
                    ? $request->input('pickup_time') 
                    : $request->input('delivery_time'),
                'total' => $producto['price'] * $producto['quantity'], // Total por producto
                'estado' => 'Pendiente'
            ]);
        }
auth()->user()->update([
    'telefono' => $request->input('telefono'),
    'direccion' => $request->input('direccion'),
    'referencia_envio' => $request->input('referencias')
]);
    
        return redirect()->route('productosVenta')->with('success', 'Pedido realizado con éxito');
    }    
}