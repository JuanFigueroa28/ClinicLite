<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    // Campos que pueden asignarse masivamente
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Relación: un permiso puede pertenecer a muchos roles.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }
}
