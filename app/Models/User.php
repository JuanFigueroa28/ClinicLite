<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Campos que pueden asignarse masivamente
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'document',
        'email',
        'password',
        'phone',
        'address',
        'role_id',
        'status',
    ];

    /**
     * Campos ocultos al devolver el modelo como JSON o array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts: define tipos automáticos de ciertos campos
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean',
    ];

    /**
     * Relación: un usuario pertenece a un rol
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Método helper: verifica si el usuario tiene un rol específico
     */
    public function hasRole(string $roleName): bool
    {
        return $this->role && strtolower($this->role->name) === strtolower($roleName);
    }

    /**
     * Método helper: verifica si el usuario tiene un permiso específico
     * (heredado desde su rol)
     */
    public function hasPermission(string $permissionSlug): bool
    {
        if (!$this->role) {
            return false;
        }

        return $this->role->permissions->contains('slug', $permissionSlug);
    }
}
