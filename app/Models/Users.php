<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'address',
        'role_id',
        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones con otros modelos
    |--------------------------------------------------------------------------
    */

    // Un usuario pertenece a un rol
    public function role()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }

    // Un usuario puede tener muchas citas (como paciente)
    public function appointments()
    {
        return $this->hasMany(Appointments::class, 'patient_id');
    }

    // Un usuario puede ser responsable de muchos historiales de cita
    public function appointmentHistories()
    {
        return $this->hasMany(Appointment_history::class, 'user_responsible');
    }

    // Un usuario puede estar vinculado a un registro de doctor (si aplica)
    public function doctor()
    {
        return $this->hasOne(Doctors::class, 'user_id');
    }
}
