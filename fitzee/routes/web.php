<?php

use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RepController;
use App\Http\Controllers\SessionController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExercisesController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\PasswordResetController;

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
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::post('/forgot', [PasswordResetController::class, 'request'])->name('request-reset-password');
Route::post('/reset', [PasswordResetController::class, 'reset'])->name('reset-password');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/my-profile', [MyProfileController::class, 'store'])->name('my-profile');
    Route::get('/my-profile', [MyProfileController::class, 'show'])->name('my-profile');
    Route::get('/settings/details', [SettingsController::class, 'show'])->name('settings.details');
    Route::get('/settings/password', [SettingsController::class, 'show'])->name('settings.password');
    Route::post('/settings/details', [SettingsController::class, 'updateDetails'])->name('settings.updateDetails');
    Route::post('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.updatePassword');
    Route::resource('/profile', ProfileController::class)->only('edit', 'update', 'destroy');

    Route::middleware('profile.complete')->group(function () {
        Route::post('/exercise/{slug}', [SeriesController::class, 'store'])->name('exercise');
        Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
        Route::get('/exercises', [ExercisesController::class, 'show'])->name('exercises');
        Route::get('/program', [ProgramController::class, 'show'])->name('program');
        Route::get('/program/generate', [ProgramController::class, 'generate'])->name('generate');
        Route::get('/program/delete', [ProgramController::class, 'delete'])->name('delete');
        Route::get('/session/{id}', [SessionController::class, 'show'])->name('session');
        Route::get('/exercise/{slug}', [ExerciseController::class, 'show'])->name('exercise');
        Route::post('/exercise/{slug}/toggle', [ExerciseController::class, 'toggleExercise'])->name('exercise.toggle');
        Route::post('/program/{id}/toggle', [ProgramController::class, 'toggleProgram'])->name('program.toggle');
        Route::put('/rep/{id}/edit', [RepController::class, 'edit'])->name('rep.edit');
        Route::post('/rep/add', [RepController::class, 'store'])->name('rep.add');
        Route::delete('/rep/{id}/destroy', [RepController::class, 'destroy'])->name('rep.destroy');
    });
});

require __DIR__.'/auth.php';
