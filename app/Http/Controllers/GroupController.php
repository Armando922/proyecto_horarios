<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;

// GestiÃ³n de grupos/paralelos de estudiantes (ej: "1A", "2B").
// Se usa despuÃ©s al armar el horario dentro de available_classes.

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::latest()->paginate(15);

        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(StoreGroupRequest $request)
    {
        Group::create($request->validated());

        return redirect()->route('groups.index')
            ->with('success', 'Grupo registrado correctamente.');
    }

    public function show(Group $group)
    {
        return view('groups.show', compact('group'));
    }

    public function edit(Group $group)
    {
        return view('groups.edit', compact('group'));
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($request->validated());

        return redirect()->route('groups.index')
            ->with('success', 'Grupo actualizado correctamente.');
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('groups.index')
            ->with('success', 'Grupo eliminado correctamente.');
    }
}