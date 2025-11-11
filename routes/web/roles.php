<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Módulo: Roles
|--------------------------------------------------------------------------
| Solo el Administrador puede acceder a estas rutas (según la matriz).
|
*/

Route::middleware(['authorized:view-roles'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
});

Route::middleware(['authorized:create-role'])->group(function () {
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
});

Route::middleware(['authorized:edit-role'])->group(function () {
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
});

Route::middleware(['authorized:delete-role'])->group(function () {
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
});
