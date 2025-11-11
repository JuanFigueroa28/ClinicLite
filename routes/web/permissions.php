<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| Módulo: Permisos
|--------------------------------------------------------------------------
| Solo el Administrador tiene acceso a este módulo.
|
*/

Route::middleware(['authorized:view-roles'])->group(function () {
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
});

Route::middleware(['authorized:create-role'])->group(function () {
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
});

Route::middleware(['authorized:edit-role'])->group(function () {
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
});

Route::middleware(['authorized:delete-role'])->group(function () {
    Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
});
