<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    use HasFactory;

    protected $table = 'doctors';

    protected $fillable = [
        'specialty_id',
        'license_number',
        'user_id'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones con otros modelos
    |--------------------------------------------------------------------------
    */

    // Un doctor pertenece a una especialidad
    public function specialty()
    {
        return $this->belongsTo(Specialties::class, 'specialty_id');
    }

    // Un doctor pertenece a un usuario (perfil de usuario vinculado)
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    // Un doctor tiene muchos horarios
    public function schedules()
    {
        return $this->hasMany(Schedules::class, 'doctor_id');
    }

    // Un doctor tiene muchas citas
    public function appointments()
    {
        return $this->hasMany(Appointments::class, 'doctor_id');
    }
}
