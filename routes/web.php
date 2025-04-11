<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\authAdminController;
use App\Http\Controllers\administracionController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ventaProductoController;

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
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('loginUser');
Route::post('/login', [AuthController::class, 'login'])->name('login.submitUser');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', function () {
    return redirect()->route('productosVenta');
});

Route::get('/carrito', function () {
    return view('contenido.carrito');
});

Route::get('/checkout', function () {
    return view('contenido.checkout');
});

Route::post('/guardar-pedido', [PedidoController::class, 'store'])
     ->name('pedidos.store')
     ->middleware('auth');

Route::get('/productosVenta', [ventaProductoController::class, 'index'])->name('productosVenta');


Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/pedidos', [PedidoController::class, 'mostrarPedidos']);

Route::get('/producto', [administracionController::class, 'mostrarProductos']);
Route::post('/productos/agregar', [administracionController::class, 'agregarProductos'])->name('productos.agregar');
Route::prefix('producto')->group(function () {
Route::get('/{id}/edit', [administracionController::class, 'editarProducto'])->name('producto.editar');
Route::put('/{id}', [administracionController::class, 'actualizarProducto'])->name('producto.actualizar');
Route::put('/{id}/eliminar', [administracionController::class, 'eliminarProducto'])->name('producto.eliminar');

});

Route::get('/usuarios', [administracionController::class, 'mostrarUsuarios']);
Route::put('/usuarios/{id}', [administracionController::class, 'eliminarUsuario'])->name('user.eliminar');

Route::get('/categorias', [administracionController::class, 'mostrarCategoria']);
Route::post('/categorias/agregar', [administracionController::class, 'agregarCategoria'])->name('categoria.agregar');
Route::put('/categorias/eliminar/{id}', [administracionController::class, 'eliminarCategoria'])->name('categoria.eliminar');
Route::prefix('categorias')->group(function () {
    Route::get('/{id}/edit', [administracionController::class, 'editarCategoria'])->name('categoria.editar');
    Route::put('/{id}', [administracionController::class, 'actualizarCategoria'])->name('categoria.actualizar');
});


Route::prefix('administrador')->group(function () {
    Route::get('/login', [authAdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [authAdminController::class, 'login'])->name('login.submit');
    Route::post('/logout', [authAdminController::class, 'logout'])->name('logout');
    Route::get('/register', [authAdminController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/register', [authAdminController::class, 'register'])->name('admin.register.submit');
});

