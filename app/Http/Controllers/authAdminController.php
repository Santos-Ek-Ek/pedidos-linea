<?php

namespace App\Http\Controllers;

use App\Models\administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class authAdminController extends Controller
{
    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('administrador.auth.register');
    }

    // Procesar el registro
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_completo' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:administradores',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required|accepted',
        ], [
            'terms.required' => 'Debes aceptar los términos y condiciones',
            'terms.accepted' => 'Debes aceptar los términos y condiciones',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $admin = administrador::create([
            'nombre_completo' => $request->nombre_completo,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth('admin')->login($admin);

        return redirect('administrador/loginAdmin')->with('success', 'Registro exitoso!');
    }
      // Mostrar formulario de login
      public function showLoginForm()
      {
          return view('administrador.auth.login');
      }
  
      // Procesar el login
      public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    if (Auth::guard('admin')->attempt([
        'email' => $request->email,
        'password' => $request->password
    ], $request->remember)) {
        
        $request->session()->regenerate();
        return redirect()->intended(route('pedidosVista'));
    }

    return back()->withErrors([
        'email' => 'Credenciales incorrectas',
    ])->onlyInput('email');
}
      // Cerrar sesión
      public function logout(Request $request)
      {
          Auth::guard('admin')->logout();
  
          $request->session()->invalidate();
          $request->session()->regenerateToken();
  
          return redirect('administrador/loginAdmin')
              ->with('status', 'Has cerrado sesión correctamente.');
      }
}
