<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialties extends Model
{
    use HasFactory;

    protected $table = 'specialties';

    protected $fillable = [
        'name',
        'description'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones con otros modelos
    |--------------------------------------------------------------------------
    */

    // Una especialidad puede tener muchos doctores
    public function doctors()
    {
        return $this->hasMany(Doctors::class, 'specialty_id');
    }
}
