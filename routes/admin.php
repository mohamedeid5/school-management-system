<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\FeeInvoiceController;
use App\Http\Controllers\Admin\FeesController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\GraduationController;
use App\Http\Controllers\Admin\LibraryController;
use App\Http\Controllers\Admin\OnlineClassController;
use App\Http\Controllers\Admin\PaymentStudentController;
use App\Http\Controllers\Admin\ProcessingFeeController;
use App\Http\Controllers\Admin\PromotionsController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ReceiptStudentController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\FileController;

/*

Route::middleware('role:admin|teacher')->group(function () {
    Route::resource('attendances',   AttendanceController::class)->only(['index', 'show', 'create', 'store']);
    Route::resource('online-classes', OnlineClassController::class)->except(['index', 'show']);
    Route::resource('questions',     QuestionController::class)->only(['index', 'show']);
    Route::resource('libraries',     LibraryController::class);
});

-------------------------------------------------------------------------

Route::middleware('role:admin|teacher|student|parent')->group(function () {
    Route::resource('sections',      SectionController::class)->only(['index', 'show']);
    Route::resource('subjects',      SubjectController::class)->only(['index', 'show']);
    Route::resource('students',      StudentController::class)->only(['index', 'show']);
    Route::resource('online-classes', OnlineClassController::class)->only(['index', 'show']);
    Route::resource('exams',         ExamController::class)->only(['index', 'show']);
    Route::resource('libraries',     LibraryController::class)->only(['index', 'show']);
});

*/

/*
|--------------------------------------------------------------------------
| Admin Only
|--------------------------------------------------------------------------
*/


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Teachers & Students
Route::resource('teachers', TeacherController::class);
Route::resource('students', StudentController::class);

// Classrooms & Sections
Route::delete('/classrooms/delete-selected', [ClassroomController::class, 'destroySelected'])
    ->name('classrooms.destroySelected');
Route::resource('classrooms', ClassroomController::class);
Route::resource('sections',   SectionController::class);

// Parents
Route::view('add-parent', 'livewire.parents')->name('add_parent');

// File Downloads
Route::get('student/{id}/download-attachment',    [FileController::class, 'download'])->name('students.download_attachment');
Route::delete('student/{id}/delete-attachment',   [FileController::class, 'delete'])->name('students.delete_attachment');

// Promotions
Route::controller(PromotionsController::class)->group(function () {
    Route::get('promotions',             'index')->name('promotions.index');
    Route::post('promotions',            'store')->name('promotions.store');
    Route::get('promotions/management',  'management')->name('promotions.management');
    Route::delete('promotions/{id}',     'destroy')->name('promotions.destroy');
});

// Graduations
Route::controller(GraduationController::class)->group(function () {
    Route::get('graduations',                'index')->name('graduations.index');
    Route::get('graduations/create',         'create')->name('graduations.create');
    Route::post('graduations',               'store')->name('graduations.store');
    Route::put('graduations/restore/{id}',   'restore')->name('graduations.restore');
    Route::delete('graduations/destroy/{id}', 'destroy')->name('graduations.destroy');
});

// Financial
Route::resource('fees',               FeesController::class);
Route::resource('fee-invoices',       FeeInvoiceController::class);
Route::resource('receipt-students',   ReceiptStudentController::class);
Route::resource('processing-fees',    ProcessingFeeController::class);
Route::resource('payment-students',   PaymentStudentController::class);

// Academic
Route::resource('grades',         GradeController::class);
Route::resource('subjects',       SubjectController::class);
Route::resource('exams',          ExamController::class);
Route::resource('questions',      QuestionController::class);
Route::resource('libraries',      LibraryController::class);
Route::resource('online-classes', OnlineClassController::class);
Route::resource('attendances',    AttendanceController::class);

// Settings
Route::get('settings/edit', [SettingController::class, 'edit'])->name('settings.edit');
Route::put('settings',      [SettingController::class, 'update'])->name('settings.update');

