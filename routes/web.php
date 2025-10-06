<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, UsersController, RolesController, AppointmentController};
use App\Models\{Users, Doctors, Appointments, Roles, Permissions};


// -----------------------------------------------------------------------------
// RUTAS PRINCIPALES DEL SISTEMA (panel administrativo)
// -----------------------------------------------------------------------------
// Estas rutas están bajo prefijo /admin y secciones separadas por módulo.
// Cada grupo de rutas pertenece a un área específica del proyecto.
// El encargado del BACKEND debe crear los controladores y métodos correspondientes.
// -----------------------------------------------------------------------------

Route::prefix('admin')->group(function () {

    // DASHBOARD
    // -------------------------------------------------------------------------
    // Muestra las estadísticas generales del sistema (ya implementado visualmente)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    // PACIENTES
    // -------------------------------------------------------------------------
    // Encargado del BACKEND debe implementar el CRUD real (Pacientes)
    Route::view('/pacientes', 'admin.pacientes.index')->name('pacientes.index');
    Route::view('/pacientes/nuevo', 'admin.pacientes.create')->name('pacientes.create');

    // DOCTORES
    // -------------------------------------------------------------------------
    Route::view('/doctores', 'admin.doctores.index')->name('doctores.index');
    Route::view('/doctores/nuevo', 'admin.doctores.create')->name('doctores.create');

    // CITAS
    // -------------------------------------------------------------------------
    Route::view('/citas', 'admin.citas.index')->name('citas.index');
    Route::view('/citas/nueva', 'admin.citas.create')->name('citas.create');

    // USUARIOS
    // -------------------------------------------------------------------------
    // Sección dedicada al control de usuarios del sistema (roles, permisos, etc.)
    // El encargado del BACKEND debe implementar el controlador:
    // php artisan make:controller UsuarioController --resource
    Route::view('/usuarios', 'admin.usuarios.index')->name('usuarios.index');
    Route::view('/usuarios/nuevo', 'admin.usuarios.create')->name('usuarios.create');
    Route::view('/usuarios/editar', 'admin.usuarios.edit')->name('usuarios.edit');

    // ROLES Y PERMISOS
    // -------------------------------------------------------------------------
    Route::get('/roles/nuevo', [RolesController::class, 'create'])->name('roles.create');
    Route::resource('roles', RolesController::class)->except(['create', 'show']);


    // AGENDA Y HORARIOS
    // -------------------------------------------------------------------------
    // Mostrará las citas distribuidas por día y hora (visual pendiente de citas).
    // El encargado del BACKEND debe crear el controlador AgendaController.
    Route::view('/agenda', 'admin.agenda.index')->name('agenda.index');

    // PERFIL (ACCOUNTING)
    // -------------------------------------------------------------------------
    // Sección de perfil del usuario actual (ver datos personales, editar).
    // Visual pendiente de implementar.
    Route::view('/perfil', 'profile.show')->name('perfil.show');
});

// -----------------------------------------------------------------------------
// AUTENTICACIÓN (LOGIN / REGISTRO / LOGOUT)
// -----------------------------------------------------------------------------
// Estas vistas deben existir dentro de resources/views/auth/
// Solo visual; el backend las conectará a Laravel Breeze o Auth::routes()
// -----------------------------------------------------------------------------

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::view('/logout', 'auth.logout')->name('logout');
