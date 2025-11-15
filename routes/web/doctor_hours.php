<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorHoursController;

Route::middleware(['auth', 'verified'])
    ->group(function () {
        
        // Ruta para la vista HTML de lista de horarios
        Route::get('/doctor_hours', [DoctorHoursController::class, 'index'])
            ->middleware('authorized:view-agenda')
            ->name('doctor_hours.index');
            
        // Ruta para el formulario de creación
        Route::get('/doctor_hours/create', [DoctorHoursController::class, 'create'])
            ->middleware('authorized:manage-schedule')
            ->name('doctor_hours.create');
            
        // Ruta para guardar nuevo horario (API)
        Route::post('/doctor_hours/store', [DoctorHoursController::class, 'store'])
            ->middleware('authorized:manage-schedule')
            ->name('doctor_hours.store');
            
        // Ruta API para obtener horarios por médico (mantener separada)
        Route::get('/api/doctor-hours/{id}', [DoctorHoursController::class, 'apiIndex'])
            ->middleware('authorized:view-agenda')
            ->name('doctor_hours.api.index');

        // Ver mi agenda (médico)
        Route::get('/doctor_hours/my', [DoctorHoursController::class, 'myIndex'])
            ->middleware('authorized:view-my-agenda')
            ->name('doctor_hours.my');

        // Editar horario
        Route::get('/doctor_hours/{horario}/edit', [DoctorHoursController::class, 'edit'])
            ->middleware('authorized:manage-schedule')
            ->name('doctor_hours.edit');

        // Actualizar horario
        Route::put('/doctor_hours/{horario}', [DoctorHoursController::class, 'update'])
            ->middleware('authorized:manage-schedule')
            ->name('doctor_hours.update');

        // Eliminar horario
        Route::delete('/doctor_hours/{horario}', [DoctorHoursController::class, 'destroy'])
            ->middleware('authorized:delete-schedule')
            ->name('doctor_hours.destroy');
    });