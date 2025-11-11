<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\RoleHelper;

class AuthorizedMiddleware
{
    public function handle(Request $request, Closure $next, $permission = null): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!empty($permission) && !RoleHelper::isAuthorized($permission)) {
            abort(403, 'No tienes autorización para realizar esta acción.');
        }

        return $next($request);
    }
}
