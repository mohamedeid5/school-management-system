<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\TeacherController;

Route::apiResource('grades', GradeController::class);
Route::apiResource('classrooms', ClassroomController::class);
Route::apiResource('sections', SectionController::class);
Route::apiResource('subjects', SubjectController::class);
Route::apiResource('teachers', TeacherController::class);
