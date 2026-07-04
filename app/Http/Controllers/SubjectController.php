<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::latest()->paginate(15);

        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(StoreSubjectRequest $request)
    {
        Subject::create($request->validated());

        return redirect()->route('subjects.index')
            ->with('success', 'Materia registrada correctamente.');
    }

    public function show(Subject $subject)
    {
        $subject->load('prerequisites');

        $availableSubjects = Subject::where('id', '!=', $subject->id)
            ->whereNotIn(
                'id',
                $subject->prerequisites->pluck('id')
            )
            ->orderBy('nombre')
            ->get();

        return view('subjects.show', compact(
            'subject',
            'availableSubjects'
        ));
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());

        return redirect()->route('subjects.index')
            ->with('success', 'Materia actualizada correctamente.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')
            ->with('success', 'Materia eliminada correctamente.');
    }
}
