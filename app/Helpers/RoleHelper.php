<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;

class RoleHelper
{
    /**
     * Verifica si hay un usuario autenticado.
     */
    public static function hasUser(): bool
    {
        return Auth::check();
    }

    /**
     * Obtiene el rol del usuario autenticado.
     */
    public static function currentRoleName(): ?string
    {
        if (!self::hasUser()) return null;

        return Auth::user()->role->name ?? null;
    }

    /**
     * Verifica si el usuario actual es Administrador.
     */
    public static function currentUserIsAdmin(): bool
    {
        $role = Str::lower(Str::ascii(self::currentRoleName() ?? ''));
        return in_array($role, ['administrador', 'admin'], true);
    }

    /**
     * Verifica si el usuario actual es Recepcionista.
     */
    public static function currentUserIsRecepcionista(): bool
    {
        $role = Str::lower(Str::ascii(self::currentRoleName() ?? ''));
        return $role === 'recepcionista';
    }

    /**
     * Verifica si el usuario actual es Médico.
     */
    public static function currentUserIsMedico(): bool
    {
        $role = Str::lower(Str::ascii(self::currentRoleName() ?? ''));
        return in_array($role, ['medico', 'médico'], true);
    }

    /**
     * Verifica si el usuario actual es Paciente.
     */
    public static function currentUserIsPaciente(): bool
    {
        $role = Str::lower(Str::ascii(self::currentRoleName() ?? ''));
        return $role === 'paciente';
    }

    /**
     * Verifica si el usuario tiene un permiso específico (por slug).
     * Ejemplo: RoleHelper::isAuthorized('edit-user');
     */
    public static function isAuthorized(string $slug): bool
    {
        try {
            if (!Auth::check()) return false;

            $user = Auth::user();
            $permissions = $user->role?->permissions ?? collect();

            return $permissions->contains('slug', $slug);

        } catch (Exception $ex) {
            report($ex);
            return false;
        }
    }
}
