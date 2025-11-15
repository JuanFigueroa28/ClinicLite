<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorHoursRequest;
use Illuminate\Http\Request;
use App\Models\Doctor_Hours;
use App\Services\DoctorHoursService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DoctorHoursController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo horario
     */
    public function create(): View
    {
        $medicos = \App\Models\User::whereHas('role', function ($q) {
            $q->where('name', 'Médico');
        })->orderBy('first_name')->orderBy('last_name')->get(['id','first_name','last_name','email']);

        return view('doctor_hours.create', compact('medicos'));
    }

    /**
     * Muestra la lista de horarios (vista HTML)
     */
    public function index(): View  
    {
        $horarios = Doctor_Hours::with('doctor')->get();
        $medicos = \App\Models\User::whereHas('role', function ($q) {
            $q->where('name', 'Médico');
        })->orderBy('first_name')->orderBy('last_name')->get(['id','first_name','last_name']);
        return view('doctor_hours.index', compact('horarios','medicos'));
    }

    /**
     * Muestra la agenda del médico autenticado
     */
    public function myIndex(): View
    {
        $doctorId = Auth::id();
        $horarios = Doctor_Hours::with('doctor')->where('doctor_id', $doctorId)->get();
        $medicos = \App\Models\User::whereHas('role', function ($q) {
            $q->where('name', 'Médico');
        })->orderBy('first_name')->orderBy('last_name')->get(['id','first_name','last_name']);
        return view('doctor_hours.index', compact('horarios','medicos'));
    }

    public function edit(Doctor_Hours $horario): View
    {
        $medicos = \App\Models\User::whereHas('role', function ($q) {
            $q->where('name', 'Médico');
        })->orderBy('first_name')->orderBy('last_name')->get(['id','first_name','last_name','email']);
        return view('doctor_hours.edit', compact('horario','medicos'));
    }

    public function apiIndex($id, DoctorHoursService $service)
    {
        return response()->json(
            $service->listarPorMedico($id)
        );
    }

    public function store(DoctorHoursRequest $request, DoctorHoursService $service)
    {
        // Genera horarios para un rango de fechas, filtrando por los días seleccionados.
        // Evita duplicados mediante la capa de servicio y retorna métricas de creación/omisiones.
        $data = $request->validated();
        $created = [];
        $skipped = 0;
        $start = Carbon::parse($request->input('start_date'));
        $end = Carbon::parse($request->input('end_date'));
        $days = $request->input('week_days');
        $map = [0 => 'Domingo', 1 => 'Lunes', 2 => 'Martes', 3 => 'Miercoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sabado'];
        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $dayName = $map[$date->dayOfWeek];
            if (!in_array($dayName, $days)) {
                continue;
            }
            $row = $data;
            $row['week_day'] = $dayName;
            $row['date'] = $date->toDateString();
            unset($row['week_days'], $row['start_date'], $row['end_date']);
            $item = $service->crear($row);
            if ($item) {
                $created[] = $item;
            } else {
                $skipped++;
            }
        }
        if ($request->routeIs('doctor_hours.store')) {
            // Flujo web: redirecciona con mensaje de estado para mostrar alerta en el listado.
            return redirect()->route('doctor_hours.index')
                ->with('status', 'Horarios creados: '.count($created).' | Duplicados omitidos: '.$skipped);
        }
        return response()->json([
            'created' => $created,
            'skipped' => $skipped,
        ], 201);
    }

    public function update(DoctorHoursRequest $request, Doctor_Hours $horario, DoctorHoursService $service)
    {
        // Edición parcial: solo se actualizan los campos enviados.
        // La validación permite enviar únicamente inicio, fin o duración.
        $data = $request->validated();
        $updated = $service->actualizar($horario, $data);
        return redirect()->route('doctor_hours.index')
            ->with('status', 'Horario actualizado correctamente');
    }


    public function destroy($horario, DoctorHoursService $service, \Illuminate\Http\Request $request)
    {
        // Elimina un horario. Responde JSON en peticiones AJAX y redirige en flujo web.
        $model = Doctor_Hours::find($horario);
        if (!$model) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Horario no encontrado'], 404);
            }
            return redirect()->route('doctor_hours.index')->with('status', 'El horario ya no existe');
        }
        $service->eliminar($model);
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Horario eliminado correctamente'], 200);
        }
        return redirect()->route('doctor_hours.index')->with('status', 'Horario eliminado correctamente');
    }

    public function doctorHours($id, DoctorHoursService $service)
    {
        $doctor = Auth::user();
        return response()->json(
            Doctor_Hours::where('doctor_id', $doctor->id)->get()
        );
    }
}