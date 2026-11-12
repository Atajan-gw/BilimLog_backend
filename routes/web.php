<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\TeacherController;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');

    Route::middleware(['auth', AdminMiddleware::class])->group(function () {

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('/students', StudentController::class);

        Route::resource('groups', GroupController::class);
        Route::resource('teachers', TeacherController::class);
    });
});
