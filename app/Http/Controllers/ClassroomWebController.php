<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassroomRequest;
use App\Models\Classroom;

class ClassroomWebController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::latest()->paginate(15);

        return view('classrooms.index', compact('classrooms'));
    }

    public function create()
    {
        return view('classrooms.create');
    }

    public function store(StoreClassroomRequest $request)
    {
        Classroom::create($request->validated());

        return redirect()->route('classrooms.index')
            ->with('success', 'Aula registrada correctamente.');
    }
}
