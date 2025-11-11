<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'doctor_id',
        'day_of_week',
        'start_time',
        'end_time',
        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones con otros modelos
    |--------------------------------------------------------------------------
    */

    // Un horario pertenece a un doctor
    public function doctor()
    {
        return $this->belongsTo(Doctors::class, 'doctor_id');
    }

    // Un horario puede tener muchas citas
    public function appointments()
    {
        return $this->hasMany(Appointments::class, 'schedule_id');
    }
}
