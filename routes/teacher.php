<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\AttendanceController;
use App\Http\Controllers\Teacher\ExamController;
use App\Http\Controllers\Teacher\LibraryController;
use App\Http\Controllers\Teacher\OnlineClassController;
use App\Http\Controllers\Teacher\QuestionController;
use App\Http\Controllers\Teacher\SectionController;
use App\Http\Controllers\Teacher\StudentController;
use App\Http\Controllers\Teacher\SubjectController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Sections (read-only)
Route::resource('sections', SectionController::class)->only(['index', 'show']);

// Students (read-only)
Route::resource('students', StudentController::class)->only(['index', 'show']);

// Subjects (read-only)
Route::resource('subjects', SubjectController::class)->only(['index', 'show']);

// Attendances
Route::resource('attendances', AttendanceController::class)->only(['index', 'create','show', 'store']);

// Online Classes (full CRUD)
Route::resource('online-classes', OnlineClassController::class);

// Exams (full CRUD)
Route::resource('exams', ExamController::class);

// Questions (full CRUD)
Route::resource('questions', QuestionController::class);

// Libraries (full CRUD)
Route::resource('libraries', LibraryController::class);
