<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ExamController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\MessageController;
use App\Http\Controllers\Dashboard\QuestionController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\SkillController;
use App\Http\Controllers\Dashboard\StudentController;
use Illuminate\Support\Facades\Route;

// General
Route::get('', [HomeController::class, 'index'])->name('home.index');
// Categories
Route::resource('categories', CategoryController::class);
Route::patch('categories/{category}/toggle', [CategoryController::class, 'toggle'])->name('categories.toggle');
// Skills
Route::resource('skills', SkillController::class);
Route::patch('skills/{skill}/toggle', [SkillController::class, 'toggle'])->name('skills.toggle');
// Exams
Route::resource('exams', ExamController::class);
Route::resource('exams.questions', QuestionController::class)->except('show', 'destroy')->shallow();
Route::patch('exams/{exam}/toggle', [ExamController::class, 'toggle'])->name('exams.toggle');
// Students
Route::prefix('students')->name('students.')->group(function () {
    Route::get('', [StudentController::class, 'index'])->name('index');
    Route::get('{user}/scoreboard', [StudentController::class, 'scoreboard'])->name('scoreboard');
    Route::patch('{user}/exams/{exam}/open', [StudentController::class, 'openExam'])->name('exams.open');
    Route::patch('{user}/exams/{exam}/close', [StudentController::class, 'closeExam'])->name('exams.close');
});
// Admins
Route::prefix('admins')->name('admins.')->middleware('role:admin')->group(function () {
    Route::get('', [AdminController::class, 'index'])->name('index');
    Route::get('create', [AdminController::class, 'create'])->name('create');
    Route::post('', [AdminController::class, 'store'])->name('store');
    Route::patch('{user}/promote', [AdminController::class, 'promote'])->name('promote');
    Route::patch('{user}/demote', [AdminController::class, 'demote'])->name('demote');
});
// Messages
Route::prefix('messages')->name('messages.')->group(function () {
    Route::get('', [MessageController::class, 'index'])->name('index');
    Route::get('{message}', [MessageController::class, 'show'])->name('show');
    Route::post('{message}/reply', [MessageController::class, 'reply'])->name('reply');
});
// Settings
Route::prefix('settings')->name('settings.')->middleware('role:admin')->group(function () {
    Route::get('', [SettingController::class, 'index'])->name('index');
    Route::patch('', [SettingController::class, 'update'])->name('update');
});
