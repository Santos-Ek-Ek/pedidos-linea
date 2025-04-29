<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pedidos;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
            'telefono' => 'required',
        ]);
                // Validación condicional para PayPal
                if ($request->metodo_pago === 'PayPal') {
                    $request->validate([
                        'comprobante_pago' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                    ]);
                }
    
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

        // Manejo del comprobante de pago para PayPal
        $pagoPath = null;
        $numeroComprobante = null;
        
        if ($request->metodo_pago === 'PayPal' && $request->hasFile('comprobante_pago')) {
            // Generar número de comprobante único (ejemplo: PYP-12345678)
            $numeroComprobante = 'PYP-' . strtoupper(Str::random(8));
            
            $file = $request->file('comprobante_pago');
            $filename = 'comprobante_'.$numeroComprobante.'.'.$file->getClientOriginalExtension();
            $pagoPath = $file->storeAs('pagos', $filename, 'public');
        }
    
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
                'ticket_path' => $ticketPath, // Ruta relativa desde public/
                'comprobante_paypal' => $pagoPath,

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

    public function showComprobante($filename)
{
    $path = public_path('pagos/'.$filename);
    
    if (!file_exists($path)) {
        abort(404);
    }

    $mime = mime_content_type($path);
    
    return response()->file($path, [
        'Content-Type' => $mime,
        'Content-Disposition' => 'inline; filename="comprobante_pago.'.pathinfo($path, PATHINFO_EXTENSION).'"'
    ]);
}

    public function updateStatus(Request $request, $id)
{
    $pedido = pedidos::findOrFail($id);
    $pedido->estado = $request->estado;
    $pedido->save();

    return response()->json(['success' => true]);
}


public function actualizarComprobante(Request $request)
{
    $request->validate([
        'pedido_id' => 'required|exists:pedidos,id',
        'comprobante' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
    ]);

    $pedidoOriginal = Pedidos::findOrFail($request->pedido_id);

    if (!$pedidoOriginal->comprobante_paypal) {
        return response()->json([
            'success' => false,
            'message' => 'El pedido no tiene un comprobante asociado'
        ], 400);
    }

    // Obtener todos los pedidos con el mismo comprobante
    $pedidosConMismoComprobante = Pedidos::where('comprobante_paypal', $pedidoOriginal->comprobante_paypal)->get();

    // Eliminar el comprobante anterior si existe
    $oldFilePath = public_path($pedidoOriginal->comprobante_paypal);
    if (file_exists($oldFilePath)) {
        unlink($oldFilePath);
    }

    // Generar nombre del archivo igual que en store()
    $file = $request->file('comprobante');
    $numeroComprobante = 'PYP-' . strtoupper(Str::random(8));
    $filename = 'comprobante_'.$numeroComprobante.'.'.$file->getClientOriginalExtension();
    $path = 'pagos/'.$filename;
    
    // Mover el archivo a public/pagos
    $file->move(public_path('pagos'), $filename);

    // Actualizar todos los pedidos con el mismo comprobante
    Pedidos::where('comprobante_paypal', $pedidoOriginal->comprobante_paypal)
           ->update(['comprobante_paypal' => $path]);

    return response()->json([
        'success' => true,
        'message' => 'Comprobante actualizado para '.$pedidosConMismoComprobante->count().' pedidos',
        'new_path' => $path // Opcional: devolver la nueva ruta
    ]);
}

public function mostrarReportes(){
    return view ('administrador.reportes');
}

public function generarReportePedidos(Request $request)
{
    $request->validate([
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
    ]);

    $pedidos = pedidos::with(['producto' => function($query) {
            $query->select('id', 'nombre');
        }])
        ->whereDate('created_at', '>=', $request->fecha_inicio)
        ->whereDate('created_at', '<=', $request->fecha_fin)
        ->where('estado', '=', 'Enviado')
        ->get();

    // Calcular total general correctamente (subtotal * cantidad para cada pedido)
    $totalGeneral = $pedidos->sum(function($pedido) {
        return $pedido->total * $pedido->cantidad;
    });

    // Agregar el total calculado a cada pedido para mostrarlo en el PDF
    $pedidos->each(function($pedido) {
        $pedido->total_calculado = $pedido->subtotal * $pedido->cantidad;
    });

    $data = [
        'pedidos' => $pedidos,
        'fechaInicio' => $request->fecha_inicio,
        'fechaFin' => $request->fecha_fin,
        'totalGeneral' => $totalGeneral
    ];

    $pdf = PDF::loadView('administrador.reportes.pedidos', $data);
    
    $filename = 'reporte_ventas_'.$request->fecha_inicio.'_'.$request->fecha_fin.'.pdf';

    // Ruta donde se guardará el archivo
    $publicPath = public_path('reportes');
    
    // Crear el directorio si no existe
    if (!file_exists($publicPath)) {
        mkdir($publicPath, 0777, true);
    }

    // Ruta completa del archivo
    $filePath = $publicPath . '/' . $filename;

    // Eliminar el archivo existente si ya hay uno con el mismo nombre
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Guardar el nuevo PDF
    $pdf->save($filePath);


    return response()->json([
        'success' => true,
        'nuevo_reporte' => [
            'name' => $filename,
            'fecha' => now()->format('d-m-Y h:i a'),
            'url' => asset('reportes/'.$filename)
        ]
    ]);

}


public function obtenerArchivos() {
    date_default_timezone_set('America/Mexico_City');
            // Ruta de la carpeta en public/reportesg
            $carpeta = public_path('reportes');

            // Obtener la lista de archivos en la carpeta
            $archivos = scandir($carpeta);
    
            // Filtrar solo archivos PDF
            $archivosPdf = array_filter($archivos, function ($archivo) {
                return pathinfo($archivo, PATHINFO_EXTENSION) === 'pdf';
            });

            // Formatear la respuesta
            $respuesta = array_map(function ($archivo) use ($carpeta) {
                $rutaCompleta = $carpeta . '/' . $archivo;
                $fechaModificacion = filemtime($rutaCompleta); // Obtener el timestamp de la última modificación
    $fechaFormateada = date("d-m-Y h:i a", $fechaModificacion); // Formatear la fecha como "d-m-Y h:i a"
                return [
                    'name' => basename($archivo),
                    'url' => asset('reportes/' . $archivo), // Generar la URL completa para el archivo
                    'fecha'=> $fechaFormateada,
                    'timestamp' => $fechaModificacion,
                ];
            }, $archivosPdf);
            usort($respuesta, function ($a, $b) {
                return $b['timestamp'] - $a['timestamp']; // Orden descendente (más reciente primero)
            });
            $respuesta = array_map(function ($archivo) {
                unset($archivo['timestamp']);
                return $archivo;
            }, $respuesta);

            return response()->json(array_values($respuesta));
}

public function verPdf($nombreArchivo)
{
    $rutaArchivo = public_path('reportes/' . $nombreArchivo);

    if (file_exists($rutaArchivo)) {
        return response()->file($rutaArchivo, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $nombreArchivo . '"',
        ]);
    }

    return response('Archivo no encontrado', 404);
}
}