<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_Permission extends Model
{
    use HasFactory;

    protected $table = 'role_permissions';

    protected $fillable = [
        'role_id',
        'permission_id'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones con otros modelos
    |--------------------------------------------------------------------------
    */

    // Pertenece a un rol
    public function role()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }

    // Pertenece a un permiso
    public function permission()
    {
        return $this->belongsTo(Permissions::class, 'permission_id');
    }
}
