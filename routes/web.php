<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Sections\SectionController;

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

        // grades routes
        Route::resource('grades', GradeController::class)->except('create', 'edit', 'show');

        // classrooms routes
        Route::delete('/classrooms/delete-selected', [ClassroomController::class, 'destroySelected'])
            ->name('classrooms.destroySelected');
        Route::resource('classrooms', ClassroomController::class)->except('create', 'edit', 'show');

        // sections routes
        Route::resource('sections', SectionController::class)->except('create', 'edit', 'show');
        Route::get('get-classrooms/{id}', [SectionController::class, 'getClassrooms']);

        // parents routes
       // Route::get('parents', Myparent);
        Route::view('add-parent', 'livewire.parents')->name('add_parent');

    });
});

