<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Illuminate\Http\Request;
use App\Models\producto;

class ventaProductoController extends Controller
{
    public function index()
    {
        $productos = producto::with('categoria')
        ->where('activo', 1)
        ->orderBy('nombre')
        ->get();

        $categorias = categoria::where('activo', 1)->get();
        return view('contenido.productos', compact('productos','categorias'));
    }
}
