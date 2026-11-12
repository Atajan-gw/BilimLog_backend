<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\FacultyController;
use App\Http\Controllers\Api\V1\GradeController;
use App\Http\Controllers\Api\V1\GroupController;
use App\Http\Controllers\Api\V1\StudentController;
use App\Http\Controllers\Api\V1\SubjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
        Route::get('/student/profile', [StudentController::class, 'show']);
        Route::get('/student/grades', [GradeController::class, 'index']);
        Route::apiResource('faculties', FacultyController::class)->only(['index', 'show']);
        Route::apiResource('groups', GroupController::class)->only(['index', 'show']);
        Route::apiResource('subjects', SubjectController::class)->only(['index', 'show']);
    });
});
