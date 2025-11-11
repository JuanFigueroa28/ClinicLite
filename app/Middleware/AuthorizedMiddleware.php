<?php

namespace App\Http\Middleware;

use App\Helpers\RoleHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthorizedMiddleware
{
    public function handle(Request $request, Closure $next, $permission = null): Response
    {
        // Si no hay sesión, redirige al login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Si la ruta requiere permiso específico
        if (!empty($permission)) {
            if (!RoleHelper::isAuthorized($permission)) {
                abort(403, 'No tienes autorización para realizar esta acción.');
            }
        }

        return $next($request);
    }
}
