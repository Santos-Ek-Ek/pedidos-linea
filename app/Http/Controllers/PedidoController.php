<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pedidos;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class PedidoController extends Controller
{
    public function mostrarPedidos(){
        $pedidos = pedidos::with(['producto', 'cliente'])->get();
        return view('administrador.pedidos', compact('pedidos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'direccion' => 'required',
            'referencias' => 'nullable',
            'delivery_option' => 'required|in:Pasar a recoger,Enviar a domicilio',
            'pickup_time' => 'nullable|required_if:delivery_option,Pasar a recoger',
            'delivery_time' => 'nullable|required_if:delivery_option,Enviar a domicilio',
            'productos' => 'required|json',
            'telefono' => 'required'
        ]);
    
        $productos = json_decode($request->productos, true);
        $cliente = Auth::user();

            // Verificar stock antes de procesar el pedido
    foreach ($productos as $producto) {
        $productoModel = Producto::find($producto['id']);
        if (!$productoModel) {
            return back()->with('error', 'Uno de los productos no existe');
        }
        
        if ($productoModel->disponibles < $producto['quantity']) {
            return back()->with('error', 'No hay suficiente stock para el producto: ' . $productoModel->nombre);
        }
    }
        
        // Calcular total general
        $subtotal = collect($productos)->sum(function($producto) {
            return $producto['price'] * $producto['quantity'];
        });
        
        $deliveryCost = ($request->delivery_option === 'Enviar a domicilio') ? 5.00 : 0.00;
        $total = $subtotal + $deliveryCost;

        // Generar nombre único para el ticket
        $filename = 'pedido_'.$cliente->id.'_'.now()->format('YmdHis').'.pdf';
        $ticketPath = 'tickets/'.$filename;
    
        // Crear pedidos
        $pedidosData = [];
        foreach ($productos as $producto) {
        // Actualizar el stock del producto
        $productoModel = Producto::find($producto['id']);
        $productoModel->disponibles -= $producto['quantity'];
        $productoModel->save();

            $pedido = pedidos::create([
                'cliente_id' => $cliente->id,
                'producto_id' => $producto['id'],
                'cantidad' => $producto['quantity'],
                'precio' => $producto['price'],
                'notas' => $producto['nota'] ?? null,
                'direccion' => $request->input('direccion') . ' - ' . $request->input('referencias'),
                'metodo_pago' => $request->input('metodo_pago', 'Efectivo'),
                'metodo_entrega' => $request->input('delivery_option'),
                'horario_entrega' => $request->input('delivery_option') === 'Pasar a recoger' 
                    ? $request->input('pickup_time') 
                    : $request->input('delivery_time'),
                'total' => $producto['price'] * $producto['quantity'],
                'estado' => 'Pendiente',
                'ticket_path' => $ticketPath // Ruta relativa desde public/
            ]);
            
            $pedidosData[] = $pedido;
        }
    
        // Actualizar datos del cliente
        $cliente->update([
            'telefono' => $request->input('telefono'),
            'direccion' => $request->input('direccion'),
            'referencia_envio' => $request->input('referencias')
        ]);
    
        // Generar PDF con los datos del pedido
        $pdf = Pdf::loadView('tickets.pedido', [
            'pedidos' => $pedidosData,
            'cliente' => $cliente,
            'subtotal' => $subtotal,
            'deliveryCost' => $deliveryCost,
            'total' => $total,
            'fecha' => now()->format('d/m/Y H:i:s'),
            'metodoEntrega' => $request->delivery_option,
            'horarioEntrega' => $request->delivery_option === 'Pasar a recoger' 
                ? $request->pickup_time 
                : $request->delivery_time
        ]);
    
        // Crear directorio si no existe
        if (!File::exists(public_path('tickets'))) {
            File::makeDirectory(public_path('tickets'), 0755, true);
        }
    
        // Guardar el PDF en public/tickets
        $pdf->save(public_path($ticketPath));
    
        return redirect()->route('productosVenta')
            ->with('success', 'Pedido realizado con éxito')
            ->with('ticket', $filename);
    }

    // Método para descargar/ver el ticket
    public function showTicket($filename)
    {
        $path = public_path('tickets/'.$filename);
        
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="ticket_pedido.pdf"'
        ]);
    }

    public function updateStatus(Request $request, $id)
{
    $pedido = pedidos::findOrFail($id);
    $pedido->estado = $request->estado;
    $pedido->save();

    return response()->json(['success' => true]);
}
}