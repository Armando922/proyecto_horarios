<?php

namespace App\Http\Controllers;

use App\Models\AvailableClass;
use App\Models\Group;
use App\Models\Semester;
use App\Models\Specialty;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = AvailableClass::with(['subject', 'teacher', 'classroom', 'timeSlot', 'group', 'semester', 'specialty']);

        // SEGURIDAD: Solo ver lo que pertenece al usuario logueado
        $query->where('user_id', auth()->id());

        $this->applyFilters($query, $request);
        $availableClasses = $query->get();
        $grid = $this->buildGrid($availableClasses);

        $specialties = Specialty::all();
        $semesters = Semester::all();
        $teachers = Teacher::all();
        $groups = Group::all();

        return view('schedule.grid', compact('grid', 'specialties', 'semesters', 'teachers', 'groups'));
    }

    // TAREA EXAMEN: Validar dueño en SHOW
    public function show(AvailableClass $schedule)
    {
        if ($schedule->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para ver este horario.');
        }

        return view('schedule.show', compact('schedule'));
    }

    // TAREA EXAMEN: Validar dueño en DESTROY
    public function destroy(AvailableClass $schedule)
    {
        if ($schedule->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar este horario.');
        }

        $schedule->delete();
        return redirect()->back()->with('success', 'Eliminado correctamente');
    }

    public function print(Request $request)
    {
        $query = AvailableClass::with(['subject', 'teacher', 'classroom', 'timeSlot', 'group', 'semester', 'specialty']);
        
        // SEGURIDAD EXAMEN: Solo imprimir lo propio
        $query->where('user_id', auth()->id());

        $this->applyFilters($query, $request);
        $availableClasses = $query->get();
        $grid = $this->buildGrid($availableClasses);

        return view('schedule.print', compact('grid'));
    }

    protected function applyFilters($query, Request $request): void
    {
        if ($request->filled('specialty_id')) {
            $query->where('specialty_id', $request->input('specialty_id'));
        }
        if ($request->filled('semester_id')) {
            $query->where('semester_id', $request->input('semester_id'));
        }
        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->input('teacher_id'));
        }
        if ($request->filled('group_id')) {
            $query->where('group_id', $request->input('group_id'));
        }
    }

    protected function buildGrid($availableClasses): array
    {
        $grid = [];
        foreach ($availableClasses as $class) {
            $dia = $class->timeSlot->dia_semana;
            $hora = $class->timeSlot->hora_inicio;
            $grid[$dia][$hora][] = $class;
        }
        return $grid;
    }
}
