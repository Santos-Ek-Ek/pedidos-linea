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

        return redirect('administrador/login')->with('success', 'Registro exitoso!');
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
              'email' => 'required|string|email',
              'password' => 'required|string',
          ], [
              'email.required' => 'El campo email es obligatorio',
              'email.email' => 'El email debe ser una dirección válida',
              'password.required' => 'El campo contraseña es obligatorio',
          ]);
  
          if ($validator->fails()) {
              return redirect()->back()
                  ->withErrors($validator)
                  ->withInput();
          }
  
          $credentials = $request->only('email', 'password');
          $remember = $request->has('remember');
  
          if (Auth::guard('admin')->attempt($credentials, $remember)) {
              $request->session()->regenerate();
              return redirect()->intended(url('pedidos'))
                  ->with('success', '¡Bienvenido de nuevo!');
          }
  
          return back()->withErrors([
              'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
          ])->onlyInput('email');
      }
  
      // Cerrar sesión
      public function logout(Request $request)
      {
          Auth::guard('admin')->logout();
  
          $request->session()->invalidate();
          $request->session()->regenerateToken();
  
          return redirect('administrador/login')
              ->with('status', 'Has cerrado sesión correctamente.');
      }
}
