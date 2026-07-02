<?php

use App\Http\Controllers\AvailableClassController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\TimeSlotController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuditController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home_layout', function () {
    return view('layout');
});

Route::get('/hola', function () {
    return "Hola mundo";
});

Route::get('/subjects', function () {
    return view('subjects.index');
});

Route::resource('available-classes', AvailableClassController::class);
Route::resource('semesters', SemesterController::class);
Route::resource('specialties', SpecialtyController::class);
Route::resource('time-slots', TimeSlotController::class);

// Ruta del módulo de Auditoría
Route::resource('audits', AuditController::class)->only(['index']);

Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('profile.edit');
});