<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ScheduleExportController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('users', UserController::class);
Route::apiResource('classrooms', ClassroomController::class);


Route::get(
    '/saved-schedules/{schedule}/export/pdf',
    [ScheduleExportController::class, 'pdf']
);
Route::get(
    '/saved-schedules/{schedule}/export/excel',
    [ScheduleExportController::class, 'excel']
);
Route::get(
    '/saved-schedules/{schedule}/export/excel',
    [ScheduleExportController::class, 'excel']
);