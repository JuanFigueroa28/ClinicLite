<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Exception;

class RoleHelper
{
    /**
     * Verifica si el usuario actual es administrador.
     */
    public static function currentUserIsAdmin(): bool
    {
        try {
            if (!Auth::check()) return false;

            $role = Auth::user()->role->name ?? null;
            return strtolower($role) === 'administrador';

        } catch (Exception $ex) {
            report($ex);
            return false;
        }
    }

    /**
     * Verifica si el usuario tiene un permiso (usando el slug del permiso).
     * Ejemplo: RoleHelper::isAuthorized('edit-user');
     */
    public static function isAuthorized(string $slug): bool
    {
        try {
            if (!Auth::check()) return false;

            // Si es admin, siempre autorizado
            if (self::currentUserIsAdmin()) return true;

            $user = Auth::user();

            // Carga los permisos asociados al rol
            $permissions = $user->role?->permissions ?? collect();

            return $permissions->contains('slug', $slug);

        } catch (Exception $ex) {
            report($ex);
            return false;
        }
    }
}
