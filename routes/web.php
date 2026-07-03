<?php

use App\Http\Controllers\AvailableClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavedScheduleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TimeSlotController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\SubjectPrerequisiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home_layout', function () {
    return view('layout');
});
Route::get("/hola",function(){
    return "Hola mundo";
});

Route::get('/subjects', function () {
    return view('subjects.index');
})->name('subjects.index');

Route::resource('subjects', SubjectController::class);
Route::post(
    'subjects/{subject}/prerequisites',
    [SubjectPrerequisiteController::class, 'store']
)->name('subjects.prerequisites.store');

Route::delete(
    'subjects/{subject}/prerequisites/{prerequisite}',
    [SubjectPrerequisiteController::class, 'destroy']
)->name('subjects.prerequisites.destroy');


Route::resource('available-classes', AvailableClassController::class);
Route::resource('semesters', SemesterController::class);
Route::resource('specialties', SpecialtyController::class);
Route::resource('time-slots', TimeSlotController::class);
Route::resource('groups', GroupController::class);

Route::get('/horario', [ScheduleController::class, 'index'])->name('schedule.grid');
Route::get('/horario/imprimir', [ScheduleController::class, 'print'])->name('schedule.print');

Route::resource('saved-schedules', SavedScheduleController::class)->except(['edit', 'update']);
Route::get('/saved-schedules/{savedSchedule}/imprimir', [SavedScheduleController::class, 'print'])->name('saved-schedules.print');
// Ruta del módulo de Auditoría
Route::resource('audits', AuditController::class)->only(['index']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/home', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/perfil', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/perfil/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});
