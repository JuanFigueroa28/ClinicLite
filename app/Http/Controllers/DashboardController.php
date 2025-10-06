<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Doctors;
use App\Models\Appointments;

class DashboardController extends Controller
{
    /**
     * Muestra el panel principal con estadísticas generales.
     */
    public function index()
    {
        // ---------------------------------------------------------------------
        // OBTENCIÓN DE DATOS REALES DESDE LOS MODELOS (ELOQUENT)
        // ---------------------------------------------------------------------

        // Total de pacientes registrados (usuarios con rol "Paciente")
        $totalPacientes = Users::whereHas('role', function($q) {
            $q->where('name', 'Paciente');
        })->count();

        // Total de doctores activos
        $totalDoctores = Doctors::count();

        // Total de citas programadas (status = scheduled)
        $citasProgramadas = Appointments::where('status', 'scheduled')->count();

        // Total de citas completadas (status = completed)
        $citasCompletadas = Appointments::where('status', 'completed')->count();

        // Próximas citas (últimas 5 ordenadas por fecha)
        $proximasCitas = Appointments::with(['patient', 'doctor.user'])
            ->orderBy('appointment_date', 'asc')
            ->take(5)
            ->get();

        // Datos para el gráfico (conteo de citas por día de la semana)
        $citasPorDia = Appointments::selectRaw('DAYNAME(appointment_date) as dia, COUNT(*) as total')
            ->groupBy('dia')
            ->pluck('total', 'dia');

        // Convertimos los valores a arrays compatibles con Chart.js
        $labels = $citasPorDia->keys();
        $datosCitas = $citasPorDia->values();

        // ---------------------------------------------------------------------
        // Enviamos los datos a la vista usando compact()
        // ---------------------------------------------------------------------
        return view('admin.dashboard', compact(
            'totalPacientes',
            'totalDoctores',
            'citasProgramadas',
            'citasCompletadas',
            'proximasCitas',
            'labels',
            'datosCitas'
        ));
    }
}
