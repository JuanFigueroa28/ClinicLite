<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment_history extends Model
{
    use HasFactory;

    protected $table = 'appointment_histories';

    protected $fillable = [
        'appointment_id',
        'action',
        'action_date',
        'user_responsible'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones con otros modelos
    |--------------------------------------------------------------------------
    */

    // Un registro pertenece a una cita
    public function appointment()
    {
        return $this->belongsTo(Appointments::class, 'appointment_id');
    }

    // Un registro pertenece al usuario responsable
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_responsible');
    }
}
