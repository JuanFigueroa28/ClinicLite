<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Helpers\RoleHelper;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Totales generales (puedes mantenerlos si quieres mostrarlos en la vista)
        $totalPacientes = User::whereHas('role', function ($q) {
            $q->where('name', 'Paciente');
        })->count();

        $totalDoctores = Doctor::count();
        $totalCitas = Appointment::where('status', 'programada')->count();
        $totalCitasCompletadas = Appointment::where('status', 'completada')->count();

        // 🔹 Detectar el rol y enviar la vista correspondiente
        if (RoleHelper::currentUserIsAdmin()) {
            return view('admin.dashboard', compact(
                'user',
                'totalPacientes',
                'totalDoctores',
                'totalCitas',
                'totalCitasCompletadas'
            ));
        }

        // Puedes agregar más vistas personalizadas por rol si lo deseas:
        if (RoleHelper::currentUserIsMedico()) {
            return view('medico.dashboard', compact(
                'user'
                )
            );
        }


        if (RoleHelper::currentUserIsRecepcionista()) {
            return view('recepcionista.dashboard', compact(
                'user',
                'totalPacientes',
                'totalDoctores',
                'totalCitas',
            )

        );
        }

        if (RoleHelper::currentUserIsPaciente()) {
            return view('paciente.dashboard', compact(
                'user'
                )
            );
        }

        // 🔹 Por defecto (si no tiene rol específico)
        return view('dashboard', compact(

        ));
    }
}
