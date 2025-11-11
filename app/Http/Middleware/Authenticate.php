<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        // Redirigir a login cuando no esté autenticado (para peticiones web no-JSON)
        return $request->expectsJson() ? null : route('login');
    }
}
