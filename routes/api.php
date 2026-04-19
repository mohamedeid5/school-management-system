<?php

use App\Http\Controllers\Api\GradeController;
use Illuminate\Support\Facades\Route;

Route::apiResource('grades', GradeController::class);
