<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Campos que pueden asignarse masivamente
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relación: un rol puede estar asignado a muchos usuarios.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Relación: un rol puede tener muchos permisos.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    /**
     * Método helper para verificar si el rol tiene un permiso específico.
     * Ejemplo: $role->hasPermission('edit-user');
     */
    public function hasPermission(string $slug): bool
    {
        return $this->permissions->contains('slug', $slug);
    }
}
