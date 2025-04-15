<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        if (!$request->expectsJson()) {
            // Si la ruta contiene 'categorias' redirige a /administrador/login
            if ($request->is('administrador/*')) {
                return route('login');
            }
    
            // Para todo lo demás, redirige a /loginUser
            return route('loginUser');
        }
    }
}
