<?php

use App\Http\Controllers\DashboardController;

Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/paciente/dashboard', [DashboardController::class, 'index'])
            ->name('paciente.dashboard');
    });
