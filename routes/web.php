<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AjaxController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
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

    /*
    |--------------------------------------------------------------------------
    | Authenticated
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('get-classrooms/{id}', [AjaxController::class, 'getClassrooms']);
        Route::get('get-sections/{id}',   [AjaxController::class, 'getSections']);

        Route::middleware(['role:admin'])
            ->prefix('admin')
            ->name('admin.')
            ->group(base_path('routes/admin.php'));

        Route::middleware(['role:teacher'])
            ->prefix('teacher')
            ->name('teacher.')
            ->group(base_path('routes/teacher.php'));

        Route::middleware(['role:student'])
            ->prefix('student')
            ->name('student.')
            ->group(base_path('routes/student.php'));
            });

});
