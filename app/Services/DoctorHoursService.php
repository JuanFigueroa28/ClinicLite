<?php

namespace App\Services;

use App\Models\Doctor_Hours;

class DoctorHoursService
{
    public function crear(array $data)
    {
        // Prevención de duplicados: mismo médico, día, franja horaria y (si aplica) fecha.
        $query = Doctor_Hours::where('doctor_id', $data['doctor_id'])
            ->where('week_day', $data['week_day'])
            ->where('start_time', $data['start_time'])
            ->where('end_time', $data['end_time']);
        if (!empty($data['date'])) {
            $query->where('date', $data['date']);
        }
        $exists = $query->exists();

        if ($exists) {
            return null;
        }

        return Doctor_Hours::create($data);
    }

public function actualizar($horario, array $data)
{
    // Actualización parcial: solo persiste los campos presentes en $data.
    $horario->fill($data);
    $horario->save();

    return $horario;
}


    public function eliminar(Doctor_Hours $horario)
    {
        return $horario->delete();
    }

    public function listarPorMedico($doctor_id)
    {
        return Doctor_Hours::where('doctor_id', $doctor_id)->get();
    }
}
