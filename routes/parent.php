<?php

use App\Http\Controllers\Parent\DashboardController as ParentDashboardController;

/*
|--------------------------------------------------------------------------
| Parent Routes
|--------------------------------------------------------------------------
*/
Route::prefix('parent')->middleware('role:parent')->group(function () {

    Route::get('/dashboard', [ParentDashboardController::class, 'index'])->name('parent.dashboard');
});
