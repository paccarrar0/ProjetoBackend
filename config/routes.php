<?php

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
        Route::get('/admin/equipments', [EquipmentController::class, 'index'])->name('equipments.index');
    });
});
