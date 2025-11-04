<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorHoursRequest;
use Illuminate\Http\Request;
use App\Models\Doctor_Hours;
use App\Services\DoctorHoursService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class DoctorHoursController extends Controller
{
    public function index($id, DoctorHoursService $service)
    {
        return response()->json(
            $service->listarPorMedico($id)
        );
    }



    public function store(DoctorHoursRequest $request, DoctorHoursService $service)
    {
        return response()->json(
            $service->crear($request->validated()),
            201
        );
    }

    public function update(DoctorHoursRequest $request, Doctor_Hours $horario, DoctorHoursService $service)
    {
        return response()->json($service->actualizar($horario, $request->validated()));
    }

    public function destroy(Doctor_Hours $horario, DoctorHoursService $service)
    {
        $service->eliminar($horario);
        return response()->json(null, 204);
    }

    public function doctorHours($id, DoctorHoursService $service)
    {
        $doctor = Auth::user();
        return response()->json(
            Doctor_Hours::where('doctor_id', $doctor->id)->get()
        );
        // return response()->json(
        //     Doctor_Hours::where('doctor_id', $id)->get()
        // );
    }
}
