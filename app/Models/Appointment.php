<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'schedule_id',
        'appointment_date',
        'appointment_time',
        'status',
        'notes'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones con otros modelos
    |--------------------------------------------------------------------------
    */

    // Una cita pertenece a un paciente
    public function patient()
    {
        return $this->belongsTo(Users::class, 'patient_id');
    }

    // Una cita pertenece a un doctor
    public function doctor()
    {
        return $this->belongsTo(Doctors::class, 'doctor_id');
    }

    // Una cita pertenece a un horario
    public function schedule()
    {
        return $this->belongsTo(Schedules::class, 'schedule_id');
    }

    // Una cita tiene muchos historiales
    public function histories()
    {
        return $this->hasMany(Appointment_history::class, 'appointment_id');
    }
}
