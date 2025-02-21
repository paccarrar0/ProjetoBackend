<?php

use App\Controllers\MaintenanceController;
use App\Controllers\AuthenticationsController;
use App\Controllers\EquipmentController;
use App\Controllers\HomeController;
use Core\Router\Route;

// Authentication
Route::get('/login', [AuthenticationsController::class, 'new'])->name('users.login');
Route::post('/login', [AuthenticationsController::class, 'authenticate'])->name('users.authenticate');

Route::get('/', [HomeController::class, 'guestUser'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthenticationsController::class, 'destroy'])->name('users.logout');

    Route::get('/common', [HomeController::class, 'commonUser'])->name('users.common');

    //Admin Routes
    $adminMiddleware = Route::middleware('admin');
    $adminMiddleware->group(function () {
        Route::get('/admin', [HomeController::class, 'adminUser'])->name('users.admin');

        //create
        Route::get('/admin/equipments/new', [EquipmentController::class, 'new'])->name('equipments.new');
        Route::post('/admin/equipments', [EquipmentController::class, 'create'])->name('equipments.create');

        //retrieve
        Route::get('/admin/equipments', [EquipmentController::class, 'index'])->name('equipments.index');
        Route::get('/admin/equipments/{id}/show', [EquipmentController::class, 'show'])->name('equipments.show');

        //delete
        Route::delete('/admin/equipments/{id}', [EquipmentController::class, 'destroy'])->name('equipments.destroy');

        //edit
        Route::get('/admin/equipments/{id}/edit', [EquipmentController::class, 'edit'])->name('equipments.edit');
        Route::put('/admin/equipments/{id}', [EquipmentController::class, 'update'])->name('equipments.update');


        //Maintenance Routes

        //create
        Route::get('/admin/equipments/{id}/maintenances/new', [MaintenanceController::class, 'new'])
            ->name('maintenances.new');

        Route::post('/admin/equipments/{id}/maintenances', [MaintenanceController::class, 'create'])
            ->name('maintenances.create');

        //retrieve
        Route::get('/admin/equipments/{id}/maintenances', [MaintenanceController::class, 'index'])
            ->name('maintenances.index');

        //delete
        Route::delete(
            '/admin/equipments/{id}/maintenances/{maintenance_id}',
            [MaintenanceController::class, 'destroy']
        )->name('maintenances.destroy');

        //edit
        Route::get(
            '/admin/equipments/{equipment_id}/maintenances/{id}/edit',
            [MaintenanceController::class, 'edit']
        )->name('maintenances.edit');
        Route::put(
            '/admin/equipments/{equipment_id}/maintenances',
            [MaintenanceController::class, 'update']
        )->name('maintenances.update');
    });
});
