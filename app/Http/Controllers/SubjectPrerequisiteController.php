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
    public function store(StoreSubjectPrerequisiteRequest $request,Subject $subject)
    {
        if ($subject->id == $request->prerequisite_subject_id) {
            return back()
                ->withInput()
                ->withErrors([
                    'prerequisite_subject_id' =>
                        'Una materia no puede ser prerrequisito de sí misma.'
                ]);
        }

        $exists = SubjectPrerequisite::where('subject_id', $subject->id)
            ->where('prerequisite_subject_id', $request->prerequisite_subject_id)
            ->exists();

        if ($exists) {
            return back()
                ->withErrors([
                    'prerequisite_subject_id' =>
                        'Este prerrequisito ya está registrado.'
                ]);
        }

        SubjectPrerequisite::create([
            'subject_id' => $subject->id,
            'prerequisite_subject_id' => $request->prerequisite_subject_id,
        ]);

        return redirect()
            ->route('subjects.show', $subject)
            ->with('success', 'Prerrequisito agregado correctamente.');
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
            return back()->with('error', 'La relación no existe.');
        }

        return redirect()
            ->route('subjects.show', $subject)
            ->with('success', 'Prerrequisito eliminado correctamente.');
    }
}
