<?php

use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\ExamController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\SkillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('clear-cache', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return 'Cache is cleared';
});

Route::get('test', function () {
    return 'test';
});

// General
Route::get('', [HomeController::class, 'index'])->name('home.index');
Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('lang/{locale}', [LocalizationController::class, 'set'])->name('localization');
Route::prefix('profile')->name('profile.')->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('', [ProfileController::class, 'index'])->name('index');
        Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
        Route::get('change-password', [ProfileController::class, 'changePassword'])->name('change-password');
        Route::get('scoreboard', [ProfileController::class, 'scoreboard'])->middleware('role:student')->name('scoreboard');
    });
    Route::get('{user}', [ProfileController::class, 'show'])->name('show');
});
// Categories
Route::prefix('categories')->group(function () {
    Route::get('{category}', [CategoryController::class, 'show'])->name('categories.show');
});
// Skills
Route::prefix('skills')->group(function () {
    Route::get('', [SkillController::class, 'index'])->name('skills.index');
    Route::get('{skill}', [SkillController::class, 'show'])->name('skills.show');
});
// Exams
Route::prefix('exams')->group(function () {
    Route::get('', [ExamController::class, 'index'])->name('exams.index');
    Route::get('{exam}', [ExamController::class, 'show'])->name('exams.show');
    Route::middleware(['auth', 'verified', 'role:student'])->group(function () {
        Route::post('{exam}/start', [ExamController::class, 'start'])->name('exams.start');
        Route::get('{exam}/questions', [ExamController::class, 'questions'])->name('exams.questions');
        Route::post('{exam}', [ExamController::class, 'store'])->name('exams.store');
    });
});
