<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\FileController;

use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Students\PromotionsController;
use App\Http\Controllers\Students\GraduationController;

use App\Http\Controllers\Fees\FeesController;
use App\Http\Controllers\Fees\FeeInvoiceController;
use App\Http\Controllers\Fees\ReceiptStudentController;
use App\Http\Controllers\Fees\ProcessingFeeController;
use App\Http\Controllers\Fees\PaymentStudentController;

use App\Http\Controllers\Attendances\AttendanceController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Exams\ExamController;
use App\Http\Controllers\Libraries\LibraryController;
use App\Http\Controllers\Questions\QuestionController;
use App\Http\Controllers\OnlineClasses\OnlineClassController;
use App\Http\Controllers\SettingController;

Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {

    Route::get('/', fn () => redirect()->route('dashboard'));

    Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'redirect'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Guest
    |--------------------------------------------------------------------------
    */
    Route::middleware('guest')->group(function () {
        Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])
            ->middleware('throttle:login')
            ->name('login.submit');
    });


    Route::middleware('auth')->group(function () {

        // Ajax
        Route::get('get-classrooms/{id}', [AjaxController::class, 'getClassrooms']);
        Route::get('get-sections/{id}',   [AjaxController::class, 'getSections']);

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


        Route::prefix('admin')->middleware('role:admin')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        });

        Route::prefix('teacher')->middleware('role:teacher')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'teacherDashboard'])->name('teacher.dashboard');
        });

        Route::prefix('student')->middleware('role:student')->group(function () {
           // Route::get('/dashboard', [DashboardController::class, 'student'])->name('student.dashboard');
        });

        Route::prefix('parent')->middleware('role:parent')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'parentDashboard'])->name('parent.dashboard');
        });


        Route::middleware('role:admin|teacher|student|parent')->group(function () {
            Route::resource('sections', SectionController::class)->only(['index', 'show']);
            Route::resource('subjects', SubjectController::class)->only(['index', 'show']);
            Route::resource('students', StudentController::class)->only(['index', 'show']);
            Route::resource('exams', ExamController::class)->only(['index', 'show']);
            Route::resource('libraries', LibraryController::class)->only(['index', 'show']);
        });

        Route::middleware('role:admin|teacher')->group(function () {
            Route::resource('attendances', AttendanceController::class)->only(['index','show', 'create', 'store']);
            Route::resource('online-classes', OnlineClassController::class)->only(['index','show', 'create', 'store', 'edit', 'update']);
            Route::resource('questions', QuestionController::class)->only(['index','show']);
            Route::resource('libraries', LibraryController::class)->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
        });



        Route::prefix('admin')->middleware('role:admin')->group(function () {

            // Full Resources
            Route::resource('teachers', TeacherController::class);
            Route::resource('sections', SectionController::class)->except(['create','edit']);
            Route::delete('/classrooms/delete-selected', [ClassroomController::class, 'destroySelected'])
                ->name('classrooms.destroySelected');
            Route::resource('classrooms', ClassroomController::class)->except(['show']);
            Route::resource('students', StudentController::class)->except(['index','show']);

            Route::view('add-parent', 'livewire.parents')->name('add_parent');

            // Files
            Route::get('student/{id}/download-attachment', [FileController::class, 'download'])
                ->name('students.download_attachment');
            Route::delete('student/{id}/delete-attachment', [FileController::class, 'delete'])
                ->name('students.delete_attachment');

            // Promotions
            Route::controller(PromotionsController::class)->group(function () {
                Route::get('promotions', 'index')->name('promotions.index');
                Route::post('promotions', 'store')->name('promotions.store');
                Route::get('promotions/management', 'management')->name('promotions.management');
                Route::delete('promotions/{id}', 'destroy')->name('promotions.destroy');
            });

            // Graduations
            Route::controller(GraduationController::class)->group(function () {
                Route::get('graduations', 'index')->name('graduations.index');
                Route::get('graduations/create', 'create')->name('graduations.create');
                Route::post('graduations', 'store')->name('graduations.store');
                Route::put('graduations/restore/{id}', 'restore')->name('graduations.restore');
                Route::delete('graduations/destroy/{id}', 'destroy')->name('graduations.destroy');
            });

            // Financial
            Route::resource('fees', FeesController::class);
            Route::resource('fee-invoices', FeeInvoiceController::class);
            Route::resource('receipt-students', ReceiptStudentController::class);
            Route::resource('processing-fees', ProcessingFeeController::class);
            Route::resource('payment-students', PaymentStudentController::class);

            // Extra Admin Controls
            Route::resource('subjects', SubjectController::class)->except(['index','show']);
            Route::resource('exams', ExamController::class)->except(['index','show']);
            Route::resource('questions', QuestionController::class)->except(['index','show']);
            Route::resource('libraries', LibraryController::class)->except(['index','show']);
            Route::resource('online-classes', OnlineClassController::class)->only(['destroy']);
            Route::resource('attendances', AttendanceController::class)->only(['destroy']);
            Route::resource('grades', GradeController::class);

            // Settings
            Route::get('settings/edit', [SettingController::class, 'edit'])->name('settings.edit');
            Route::put('settings',      [SettingController::class, 'update'])->name('settings.update');
        });
    });
});
