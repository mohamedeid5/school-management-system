<?php

use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Students\PromotionsController;
use App\Http\Controllers\Students\GraduationController;
use App\Http\Controllers\Fees\FeesController;
use App\Http\Controllers\Fees\FeeInvoiceController;
use App\Http\Controllers\Fees\ReceiptStudentController;

Route::group(
[
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function()
{
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:login')->name('login.submit');
    });

    Route::middleware('auth')->group(function () {

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('get-classrooms/{id}', [AjaxController::class, 'getClassrooms']);
        Route::get('get-sections/{id}', [AjaxController::class, 'getSections']);

        // grades routes
        Route::resource('grades', GradeController::class)->except('create', 'edit', 'show');

        // classrooms routes
        Route::delete('/classrooms/delete-selected', [ClassroomController::class, 'destroySelected'])
            ->name('classrooms.destroySelected');
        Route::resource('classrooms', ClassroomController::class)->except('create', 'edit', 'show');

        // sections routes
        Route::resource('sections', SectionController::class)->except('create', 'edit', 'show');


        Route::view('add-parent', 'livewire.parents')->name('add_parent');

        // teachers routes
        Route::resource('teachers', TeacherController::class);

        // students routes
        Route::resource('students', StudentController::class);
        Route::get('student/{id}/download-attachment', [FileController::class, 'download'])->name('students.download_attachment');
        Route::delete('student/{id}/delete-attachment', [FileController::class, 'delete'])->name('students.delete_attachment');

        // promotions routes
        Route::get('promotions', [PromotionsController::class, 'index'])->name('promotions.index');
        Route::post('promotions', [PromotionsController::class, 'store'])->name('promotions.store');
        Route::get('promotions/management', [PromotionsController::class, 'management'])->name('promotions.management');
        Route::delete('promotions/{id}', [PromotionsController::class, 'destroy'])->name('promotions.destroy');

        // graduations routes
        Route::get('graduations', [GraduationController::class, 'index'])->name('graduations.index');
        Route::get('graduations/create', [GraduationController::class, 'create'])->name('graduations.create');
        Route::post('graduations', [GraduationController::class, 'store'])->name('graduations.store');
        Route::put('graduations/restore/{id}', [GraduationController::class, 'restore'])->name('graduations.restore');
        Route::delete('graduations/destroy/{id}', [GraduationController::class, 'destroy'])->name('graduations.destroy');

        // fees routes
        Route::resource('fees', FeesController::class);

        // fee invoices routes
        Route::resource('fee-invoices', FeeInvoiceController::class);

        // receipt students routes
        Route::resource('receipt-students', ReceiptStudentController::class);

    });
});

