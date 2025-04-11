<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register'); // Asegúrate de tener esta vista
    }

    // Procesar el registro
    public function register(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Crear el usuario
        $user = User::create([
            'name' => $request->input('name'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'activo' => '1',
            'password' => Hash::make($request->input('password')),
        ]);


        // Redireccionar al dashboard o página de inicio
        return redirect()->route('loginUser')->with('success', 'Registration successful!');
    }
        // Mostrar formulario de login
        public function showLoginForm()
        {
            return view('auth.login');
        }
    
        // Procesar el login
        public function login(Request $request)
        {
            // Validación de datos
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
    
            // Intentar autenticar al usuario
            $credentials = $request->only('email', 'password');
            $remember = $request->has('remember');
    
            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
    
                return redirect()->intended(route('productosVenta'))
                    ->with('success', 'Logged in successfully!');
            }
    
            // Si falla la autenticación
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
    
        // Cerrar sesión
        public function logout(Request $request)
        {
            Auth::logout();
    
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            return redirect()->route('loginUser')->with('success', 'Logged out successfully!');
        }
}