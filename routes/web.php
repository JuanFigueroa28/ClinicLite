<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Helpers\RoleHelper;

/*
|--------------------------------------------------------------------------
| Rutas principales
|--------------------------------------------------------------------------
*/

// Página pública principal
Route::get('/', [HomeController::class, 'index'])->name('home.index');


// Grupo de rutas protegidas
Route::middleware(['auth', 'verified'])->group(function () {

    // Redirección dinámica al dashboard según rol
    Route::get('/dashboard', function () {

        if (RoleHelper::currentUserIsAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if (RoleHelper::currentUserIsMedico()) {
            return redirect()->route('medico.dashboard');
        }

        if (RoleHelper::currentUserIsRecepcionista()) {
            return redirect()->route('recepcionista.dashboard');
        }

        if (RoleHelper::currentUserIsPaciente()) {
            return redirect()->route('paciente.dashboard');
        }

        // Por defecto
        return view('dashboard');
    })->name('dashboard');


    // Perfil (común a todos)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Módulos del sistema
    require __DIR__ . '/web/users.php';
    require __DIR__ . '/web/roles.php';
    require __DIR__ . '/web/permissions.php';

    // Dashboards separados por rol
    require __DIR__ . '/web/admin.php';
    require __DIR__ . '/web/medico.php';
    require __DIR__ . '/web/recepcionista.php';
    require __DIR__ . '/web/paciente.php';
});

// Autenticación Breeze
require __DIR__ . '/auth.php';
