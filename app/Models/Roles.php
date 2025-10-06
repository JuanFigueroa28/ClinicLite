<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'roles';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'name',
        'description'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones con otros modelos
    |--------------------------------------------------------------------------
    */

    // Un rol puede tener muchos usuarios
    public function users()
    {
        return $this->hasMany(Users::class, 'role_id');
    }

    // Un rol puede tener muchos permisos (relación muchos a muchos)
    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'role_permissions', 'role_id', 'permission_id');
    }
}
