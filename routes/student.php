<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\SubjectController;
use App\Http\Controllers\Student\ExamController;
use App\Http\Controllers\Student\AttendanceController;
use App\Http\Controllers\Student\OnlineClassController;
use App\Http\Controllers\Student\LibraryController;
use App\Http\Controllers\Student\FeeInvoiceController;

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/


// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Subjects (read-only)
Route::resource('subjects', SubjectController::class)->only(['index', 'show']);

// Exams (read-only)
Route::resource('exams', ExamController::class)->only(['index', 'show']);

// Attendances (read-only)
Route::resource('attendances', AttendanceController::class)->only(['index']);

// Online Classes (read-only)
Route::resource('online-classes', OnlineClassController::class)->only(['index', 'show']);

// Libraries (read-only)
Route::resource('libraries', LibraryController::class)->only(['index', 'show']);

// Fee Invoices (read-only)
Route::resource('fee-invoices', FeeInvoiceController::class)->only(['index', 'show']);

