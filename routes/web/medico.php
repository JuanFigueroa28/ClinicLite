<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/medico/dashboard', [DashboardController::class, 'index'])
            ->name('medico.dashboard');
    });
