<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['auth', 'role:Admin'])->prefix('admin')->group(function () {
    Route::resource('users', UserController::class)->names('admin.users');
});
Route::resource('marks', MarkController::class);

Route::middleware(['auth'])->group(function () {

    Route::resource('participants', ParticipantController::class);
    Route::resource('modules', ModuleController::class);
    Route::resource('seminars', SeminarController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('attendance', AttendanceController::class);
    Route::resource('submissions', SubmissionController::class);

});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
