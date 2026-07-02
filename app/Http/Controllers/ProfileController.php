<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $request->user()->update($request->validated());

        return redirect()->route('profile.index')->with('success', 'Perfil actualizado correctamente.');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        // El cast 'password' => 'hashed' del modelo User se encarga de
        // hashear el valor automaticamente al asignarlo.
        $request->user()->update([
            'password' => $request->validated('password'),
        ]);

        return redirect()->route('profile.index')->with('success', 'Contrasena actualizada correctamente.');
    }
}
