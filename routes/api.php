<?php

use App\Http\Controllers\DoctorHoursController;
use Illuminate\Support\Facades\Route;

Route::get('/doctor/{id}/hours', [DoctorHoursController::class, 'index']);
Route::post('/doctor-hours', [DoctorHoursController::class, 'store']);
Route::put('/doctor-hours/{horario}', [DoctorHoursController::class, 'update']);
Route::delete('/doctor-hours/{horario}', [DoctorHoursController::class, 'destroy']);
Route::get('/my-hours', [DoctorHoursController::class, 'doctorHours']);
