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
    Route::post('/pacientes/guardar', function (Request $request) {
        session()->flash('success', 'El paciente ha sido guardado correctamente (simulado).');
        return redirect()->route('pacientes.index');
    })->name('pacientes.guardar');

    Route::post('/pacientes/editar', function (Request $request) {
        session()->flash('success', 'Los datos del paciente fueron editados correctamente (simulado).');
        return redirect()->route('pacientes.index');
    })->name('pacientes.editar');

    Route::post('/pacientes/eliminar', function (Request $request) {
        session()->flash('danger', 'El paciente ha sido eliminado del registro (simulado).');
        return redirect()->route('pacientes.index');
    })->name('pacientes.eliminar');

    // Doctores
    Route::view('/doctores', 'admin.doctores.index')->name('doctores.index');
    Route::view('/doctores/nuevo', 'admin.doctores.create')->name('doctores.create');
    Route::post('/doctores/guardar', function (Request $request) {
        session()->flash('success', 'El doctor ha sido guardado correctamente (simulado).');
        return redirect()->route('doctores.index');
    })->name('doctores.guardar');

    Route::post('/doctores/editar', function (Request $request) {
        session()->flash('success', 'Los datos del doctor fueron editados correctamente (simulado).');
        return redirect()->route('doctores.index');
    })->name('doctores.editar');

    Route::post('/doctores/eliminar', function (Request $request) {
        session()->flash('danger', 'El doctor ha sido eliminado del registro (simulado).');
        return redirect()->route('doctores.index');
    })->name('doctores.eliminar');

    // Citas
    Route::view('/citas', 'admin.citas.index')->name('citas.index');
    Route::view('/citas/nueva', 'admin.citas.create')->name('citas.create');
});
