<?php

use App\Http\Controllers\Parent\DashboardController as ParentDashboardController;
use App\Http\Controllers\Parent\AttendanceController as ParentAttendanceController;
use App\Http\Controllers\Parent\ExamController as ParentExamController;
use App\Http\Controllers\Parent\SubjectController as ParentSubjectController;
use App\Http\Controllers\Parent\OnlineClassController as ParentOnlineClassController;
use App\Http\Controllers\Parent\LibraryController as ParentLibraryController;
use App\Http\Controllers\Parent\FeeInvoiceController as ParentFeeInvoiceController;

/*
|--------------------------------------------------------------------------
| Parent Routes
|--------------------------------------------------------------------------
*/

// Dashboard
Route::get('/dashboard', [ParentDashboardController::class, 'index'])->name('dashboard');

// Subjects (read-only)
Route::get('subjects', [ParentSubjectController::class, 'index'])->name('subjects.index');

// Exams (read-only)
Route::get('exams', [ParentExamController::class, 'index'])->name('exams.index');

// Attendances (read-only)
Route::get('attendances', [ParentAttendanceController::class, 'index'])->name('attendances.index');

// Online Classes (read-only)
Route::get('online-classes', [ParentOnlineClassController::class, 'index'])->name('online-classes.index');

// Libraries (read-only)
Route::get('libraries', [ParentLibraryController::class, 'index'])->name('libraries.index');

// Fee Invoices (read-only)
Route::get('fee-invoices', [ParentFeeInvoiceController::class, 'index'])->name('fee-invoices.index');
