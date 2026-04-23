<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\ParentController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\OnlineClassController;
use App\Http\Controllers\Api\DashboardController;

Route::middleware('auth:sanctum')->group(function() {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::apiResource('grades', GradeController::class);
    Route::apiResource('classrooms', ClassroomController::class);
    Route::apiResource('sections', SectionController::class);
    Route::apiResource('subjects', SubjectController::class);
    Route::apiResource('teachers', TeacherController::class);
    Route::apiResource('students', StudentController::class);
    Route::apiResource('parents', ParentController::class);
    Route::apiResource('exams', ExamController::class);
    Route::apiResource('attendances', AttendanceController::class)->only(['index', 'store']);
    Route::apiResource('questions', QuestionController::class);
    Route::apiResource('online-classes', OnlineClassController::class);


    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});

