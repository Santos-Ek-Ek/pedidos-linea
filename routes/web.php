<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\authAdminController;
use App\Http\Controllers\administracionController;
use App\Http\Controllers\comprasController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ventaProductoController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rutas de autenticación
Route::get('/registerUser', [AuthController::class, 'showRegisterForm'])->name('registerUser');
Route::post('/registerUser', [AuthController::class, 'register'])->name('registerUser.submit');
Route::get('/loginUser', [AuthController::class, 'showLoginForm'])->name('loginUser');
Route::post('/login', [AuthController::class, 'login'])->name('login.submitUser');

Route::post('/logoutUser', [AuthController::class, 'logout'])->name('logoutUser');
Route::get('/', function () {
    return redirect()->route('productosVenta');
});

Route::get('/carrito', function () {
    return view('contenido.carrito');
});

Route::get('/checkout', function () {
    return view('contenido.checkout');
})->middleware('auth');

Route::get('/contactanos', function () {
    return view('contenido.contactanos');
});




Route::middleware(['auth'])->group(function () {
    Route::get('/miCuenta', function () {
        return view('contenido.miCuenta');
    });
    Route::post('/actualizar-perfil', [authController::class, 'actualizarPerfil'])->name('actualizar.perfil');
    Route::get('/obtener-datos-usuario', function() {
        return response()->json([
            'success' => true,
            'user' => Auth::user()
        ]);
    });
    Route::post('/cambiar-contrasena', [authController::class, 'cambiarContrasena'])->name('cambiar.contrasena');
});

Route::post('/guardar-pedido', [PedidoController::class, 'store'])
     ->name('pedidos.store')
     ->middleware('auth');

Route::get('/productosVenta', [ventaProductoController::class, 'index'])->name('productosVenta');





Route::prefix('administrador')->group(function () {
    Route::get('/loginAdmin', [authAdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [authAdminController::class, 'login'])->name('login.submit');
    Route::post('/logout', [authAdminController::class, 'logout'])->name('logout');
    Route::get('/register', [authAdminController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/register', [authAdminController::class, 'register'])->name('admin.register.submit');
    
Route::get('/pedidos', [PedidoController::class, 'mostrarPedidos'])->name('pedidosVista');
Route::get('/reportes', [PedidoController::class, 'mostrarReportes'])->name('reportesVista');

Route::get('/producto', [administracionController::class, 'mostrarProductos']);
Route::post('/productos/agregar', [administracionController::class, 'agregarProductos'])->name('productos.agregar');
Route::prefix('producto')->group(function () {
Route::get('/{id}/edit', [administracionController::class, 'editarProducto'])->name('producto.editar');
Route::put('/{id}', [administracionController::class, 'actualizarProducto'])->name('producto.actualizar');
Route::put('/{id}/eliminar', [administracionController::class, 'eliminarProducto'])->name('producto.eliminar');

})->middleware('admin');

Route::post('/generar-reporte-pedidos', [PedidoController::class, 'generarReportePedidos'])
    ->name('generar.reporte.pedidos');

Route::get('/usuarios', [administracionController::class, 'mostrarUsuarios'])->middleware('admin');
Route::put('/usuarios/{id}', [administracionController::class, 'eliminarUsuario'])->name('user.eliminar')->middleware('admin');

Route::get('/categorias', [administracionController::class, 'mostrarCategoria'])->middleware('admin');
Route::post('/categorias/agregar', [administracionController::class, 'agregarCategoria'])->name('categoria.agregar');
Route::put('/categorias/eliminar/{id}', [administracionController::class, 'eliminarCategoria'])->name('categoria.eliminar');
Route::prefix('categorias')->group(function () {
    Route::get('/{id}/edit', [administracionController::class, 'editarCategoria'])->name('categoria.editar');
    Route::put('/{id}', [administracionController::class, 'actualizarCategoria'])->name('categoria.actualizar');
})->middleware('admin');
});

Route::get('/tickets/{filename}', function ($filename) {
    $path = public_path('tickets/'.$filename);
    
    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="ticket_pedido.pdf"'
    ]);
})->name('tickets.download');

Route::get('/ticketsVer/{filename}', [PedidoController::class, 'showTicket'])
     ->name('tickets.show');

     Route::put('/pedidos/{id}/update-status', [PedidoController::class, 'updateStatus'])
     ->name('pedidos.updateStatus');

     Route::get('/misCompras', [comprasController::class, 'misPedidos'])->middleware('auth');


     Route::get('/ComprobanteVer/{filename}', [PedidoController::class, 'showComprobante'])
     ->name('comprobante.show');

     Route::post('/actualizar-comprobante', [PedidoController::class, 'actualizarComprobante'])
     ->name('actualizar.comprobante')->middleware('auth');


     Route::get('/api/reportes', [PedidoController::class, 'obtenerArchivos']);

     Route::get('/ver-pdf/{nombreArchivo}', [PedidoController::class, 'verPdf'])->name('ver.pdf');


Route::get('/reportes', function() {
    $reportesPath = public_path('reportes');
    $archivos = [];
    
    if (file_exists($reportesPath)) {
        $files = scandir($reportesPath);
        
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $archivos[] = [
                    'name' => $file,
                    'fecha' => date('d-m-Y h:i a', filemtime($reportesPath.'/'.$file)),
                    'url' => asset('reportes/'.$file)
                ];
            }
        }
    }
    
    // Ordenar por fecha más reciente primero
    usort($archivos, function($a, $b) {
        return strtotime($b['fecha']) - strtotime($a['fecha']);
    });
    
    return response()->json($archivos);
});