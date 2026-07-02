<?php

use App\Http\Controllers\AvailableClassController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavedScheduleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\TimeSlotController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home_layout', function () {
    return view('layout');
});
Route::get('/hola', function () {
    return 'Hola mundo';
});

Route::get('/subjects', function () {
    return view('subjects.index');
});

Route::resource('available-classes', AvailableClassController::class);
Route::resource('semesters', SemesterController::class);
Route::resource('specialties', SpecialtyController::class);
Route::resource('time-slots', TimeSlotController::class);

Route::get('/horario', [ScheduleController::class, 'index'])->name('schedule.grid');
Route::get('/horario/imprimir', [ScheduleController::class, 'print'])->name('schedule.print');

Route::resource('saved-schedules', SavedScheduleController::class)->except(['edit', 'update']);
Route::get('/saved-schedules/{savedSchedule}/imprimir', [SavedScheduleController::class, 'print'])->name('saved-schedules.print');

Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('profile.edit');
});
