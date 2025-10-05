<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ADMIN PANEL ROUTES
Route::prefix('admin')->group(function () {
    Route::view('/', 'admin.dashboard')->name('dashboard');

    // Pacientes
    Route::view('/pacientes', 'admin.pacientes.index')->name('pacientes.index');
    Route::view('/pacientes/nuevo', 'admin.pacientes.create')->name('pacientes.create');

    // Doctores
    Route::view('/doctores', 'admin.doctores.index')->name('doctores.index');
    Route::view('/doctores/nuevo', 'admin.doctores.create')->name('doctores.create');

    // Citas
    Route::view('/citas', 'admin.citas.index')->name('citas.index');
    Route::view('/citas/nueva', 'admin.citas.create')->name('citas.create');
});
