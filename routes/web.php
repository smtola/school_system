<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Public routes (guest users)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin routes (only for admin users)
Route::middleware(['redirectIfAuthenticated'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Protected routes (only for authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Other protected routes
    Route::resource('users', UserController::class);
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('schoolClass', SchoolClassController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('fees', FeeController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('examResults', ExamResultController::class);
});
