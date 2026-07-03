<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleExportController;
use App\Http\Controllers\SubjectPrerequisiteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('users', UserController::class);
Route::apiResource('classrooms', ClassroomController::class);

Route::get(
    '/saved-schedules/{schedule}/export/pdf',
    [ScheduleExportController::class, 'pdf']
);

// Resuelto: Se eliminó la ruta duplicada
Route::get(
    '/saved-schedules/{schedule}/export/excel',
    [ScheduleExportController::class, 'excel']
);

Route::get(
    'subjects/{subject}/prerequisites',
    [SubjectPrerequisiteController::class, 'index']
);

Route::post(
    'subjects/{subject}/prerequisites',
    [SubjectPrerequisiteController::class, 'store']
);

Route::delete(
    'subjects/{subject}/prerequisites/{prerequisite}',
    [SubjectPrerequisiteController::class, 'destroy']
);