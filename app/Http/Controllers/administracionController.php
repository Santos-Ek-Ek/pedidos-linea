<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\categoria;
use App\Models\producto;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class administracionController extends Controller
{
    public function mostrarUsuarios(){
        $usuario = User::where('activo', 1)->get();
        return view('administrador.usuarios', compact('usuario'));
    }
    public function eliminarUsuario($id){
        $usuario = User::findOrfail($id);
        $usuario->activo = 0;
        $usuario->save();
        return back()->with('status','Usuario eliminado correctamente');
    }
    public function mostrarCategoria(){
        $categoria = categoria::where('activo', 1)->get();
        return view('administrador.categorias', compact('categoria'));
    }
    public function agregarCategoria(Request $request){
        $categoria = new categoria;
        $categoria->nombre = $request->input('nombre');
        $categoria->activo = '1';
        $categoria->save();
        return back()->with('status','Categoria agregada correctamente');
    }
    public function eliminarCategoria($id){
        $categoria = categoria::findOrfail($id);
        $categoria->activo = 0;
        $categoria->save();
        return back()->with('status','Usuario eliminado correctamente');
    }
    public function editarCategoria($id)
    {
        $categoria = categoria::findOrFail($id);
        return view('administrador.categorias.edit', compact('categoria'));
    }
    public function actualizarCategoria(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,'.$id
        ]);

        try {
            $categoria = categoria::findOrFail($id);
            $categoria->nombre = $request->nombre;
            $categoria->save();

            return back()->with('status','Usuario actualizado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar la categoría: '.$e->getMessage());
        }
    }

    public function mostrarProductos(){
        $productos = producto::where('activo', 1)->get();
        $categorias = categoria::where('activo', 1)->get();

        return view('administrador.productos', compact('productos','categorias'));
    }

    public function agregarProductos(Request $request){
                // Validación de datos
                $validated = $request->validate([
                    'nombre' => 'required|string|max:100',
                    'categoria' => 'required|exists:categorias,id',
                    'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                    'precio' => 'required|numeric|min:0',
                    'detalles' => 'nullable|string'
                ]);
        
                try {
                    // Crear nombre del archivo
                    $nombreProducto = Str::slug($request->nombre); // Convertir a formato URL-friendly
                    $extension = $request->file('file')->getClientOriginalExtension();
                    $nombreArchivo = $nombreProducto . '.' . $extension;
                    
                    // Crear directorio si no existe
                    $directorio = public_path('productos');
                    if (!File::exists($directorio)) {
                        File::makeDirectory($directorio, 0755, true);
                    }
        
                    // Mover la imagen al directorio public/productos
                    $request->file('file')->move($directorio, $nombreArchivo);
        
                    // Crear el producto
                    $producto = producto::create([
                        'nombre' => $validated['nombre'],
                        'categoria_id' => $validated['categoria'],
                        'imagen' => 'productos/' . $nombreArchivo, // Guardamos la ruta relativa
                        'precio' => $validated['precio'],
                        'detalle' => $validated['detalles'],
                        'activo' => true
                    ]);
        
                    return redirect()->route('productos.index')
                        ->with('success', 'Producto creado exitosamente');
        
                } catch (\Exception $e) {
                    return back()->withInput()
                        ->with('error', 'Error al crear el producto: '.$e->getMessage());
                }
    }
        public function editarProducto($id)
        {
            $producto = producto::with('categoria')->findOrFail($id);
            $categorias = categoria::where('activo', true)->get();
            return view('detalles.edit_prod', compact('producto', 'categorias'));
        }


    public function actualizarProducto(Request $request, $id)
{
    $validated = $request->validate([
        'nombre' => 'required|string|max:100',
        'categoria_id' => 'required|exists:categorias,id',
        'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'precio' => 'required|numeric|min:0',
        'detalle' => 'nullable|string'
    ]);

    try {
        $producto = producto::findOrFail($id);
        
        // Manejo de la imagen si se sube una nueva
        if ($request->hasFile('file')) {
            // Eliminar imagen anterior si existe
            if ($producto->imagen && file_exists(public_path($producto->imagen))) {
                unlink(public_path($producto->imagen));
            }
            
            // Guardar nueva imagen
            $nombreProducto = Str::slug($request->nombre);
            $extension = $request->file('file')->getClientOriginalExtension();
            $nombreArchivo = $nombreProducto . '-' . time() . '.' . $extension;
            $request->file('file')->move(public_path('productos'), $nombreArchivo);
            $validated['imagen'] = 'productos/' . $nombreArchivo;
        }

        $producto->update($validated);

        return response()->json(['success' => 'Producto actualizado correctamente']);
        
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al actualizar: ' . $e->getMessage()], 500);
    }
}

public function eliminarProducto($id){
    $producto = producto::findOrfail($id);
    $producto->activo = 0;
    $producto->save();
    return back()->with('status','Producto eliminado correctamente');
}
}
