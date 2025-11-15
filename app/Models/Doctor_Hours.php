<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor_Hours extends Model
{
    use HasFactory;

    protected $table = 'doctor_hours';

    // Campos permitidos para asignación masiva, incluyendo 'date' para agendas por fecha
    protected $fillable = [
        'doctor_id',
        'week_day',
        'date',
        'start_time',
        'end_time',
        'duration_minutes'
    ];

    public function doctor() {
        return $this->belongsTo(User::class, 'doctor_id');
    }


}
