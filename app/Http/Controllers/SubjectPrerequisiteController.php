<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectPrerequisiteRequest;
use App\Models\Subject;
use App\Models\SubjectPrerequisite;
use Illuminate\Http\Request;

class SubjectPrerequisiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Subject $subject)
    {
        return response()->json([
            'subject' => [
                'id' => $subject->id,
                'sigla' => $subject->sigla,
                'nombre' => $subject->nombre,
            ],
            'prerequisites' => $subject->prerequisites
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(
    StoreSubjectPrerequisiteRequest $request,
    Subject $subject
    )
    {
        // Verificar que la materia no sea prerrequisito de sí misma
        if ($subject->id == $request->prerequisite_subject_id) {
            return response()->json([
                'message' => 'Una materia no puede ser prerrequisito de sí misma.'
            ], 422);
        }

        // Verificar si la relación ya existe
        $exists = SubjectPrerequisite::where('subject_id', $subject->id)
            ->where('prerequisite_subject_id', $request->prerequisite_subject_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Este prerrequisito ya está registrado para esta materia.'
            ], 409);
        }

        // Crear la relación
        $subjectPrerequisite = SubjectPrerequisite::create([
            'subject_id' => $subject->id,
            'prerequisite_subject_id' => $request->prerequisite_subject_id,
        ]);

        return response()->json([
            'message' => 'Prerrequisito registrado correctamente.',
            'data' => $subjectPrerequisite
        ], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject, Subject $prerequisite)
    {
        $deleted = $subject->prerequisites()->detach($prerequisite->id);

        if ($deleted === 0) {
            return response()->json([
                'message' => 'La relación de prerrequisito no existe.'
            ], 404);
        }

        return response()->json([
            'message' => 'Prerrequisito eliminado correctamente.'
        ], 200);
    }
}
