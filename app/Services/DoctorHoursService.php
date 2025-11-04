<?php

namespace App\Services;

use App\Models\Doctor_Hours;

class DoctorHoursService
{
    public function crear(array $data)
    {
        return Doctor_Hours::create($data);
    }

    public function actualizar(Doctor_Hours $horario, array $data)
    {
        $horario->update($data);
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
