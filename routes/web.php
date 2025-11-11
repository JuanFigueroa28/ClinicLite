<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Rutas principales
|--------------------------------------------------------------------------
|
| Este archivo actúa como punto de entrada para las rutas de tu aplicación.
| Solo define las rutas globales y carga los módulos específicos.
|
*/

// Página pública principal
Route::get('/', function () {
    return view('welcome');
})->name('home');


// Dashboard principal (solo usuarios autenticados y verificados)
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Perfil de usuario (todos los roles autenticados)
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Carga de rutas modulares
    |--------------------------------------------------------------------------
    | Aquí importamos los módulos específicos del sistema:
    | - Usuarios
    | - Roles
    | - Permisos
    |
    | Más adelante podrás añadir: médicos, citas, agenda, etc.
    */
    require __DIR__ . '/web/users.php';
    require __DIR__ . '/web/roles.php';
    require __DIR__ . '/web/permissions.php';
});


// Autenticación generada por Breeze (login, register, etc.)
require __DIR__ . '/auth.php';
