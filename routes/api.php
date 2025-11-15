<?php

use App\Http\Controllers\DoctorHoursController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'authorized:view-agenda'])->get('/doctor/{id}/hours', [DoctorHoursController::class, 'index']);
Route::middleware(['auth', 'authorized:manage-schedule'])->post('/doctor-hours', [DoctorHoursController::class, 'store']);
Route::middleware(['auth', 'authorized:manage-schedule'])->put('/doctor-hours/{horario}', [DoctorHoursController::class, 'update']);
Route::middleware(['auth', 'authorized:delete-schedule'])->delete('/doctor-hours/{horario}', [DoctorHoursController::class, 'destroy']);
Route::middleware(['auth', 'authorized:view-my-agenda'])->get('/my-hours', [DoctorHoursController::class, 'doctorHours']);
