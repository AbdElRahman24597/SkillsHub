<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\ExamQuestionController;
use App\Http\Controllers\Api\SkillController;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Categories
Route::prefix('/categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{category}', [CategoryController::class, 'show']);
});

// Skills
Route::prefix('/skills')->group(function () {
    Route::get('/', [SkillController::class, 'index']);
    Route::get('/{skill}', [SkillController::class, 'show']);
});

// Exams
Route::prefix('/exams')->group(function () {
    Route::get('/', [ExamController::class, 'index']);
    Route::get('/popular', [ExamController::class, 'popular']);
    Route::get('/{id}', [ExamController::class, 'show']);
    Route::middleware(['auth:sanctum', 'verified', 'role:student'])->group(function () {
        Route::post('/{id}/start', [ExamController::class, 'start']);
        Route::get('/{id}/questions', [ExamQuestionController::class, 'index']);
        Route::post('/{id}/questions', [ExamQuestionController::class, 'store']);
    });
});
