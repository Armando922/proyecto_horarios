@extends('layouts.app')

@section('title', 'Nuevo: Docente')

@section('content')
<div class="p-6 max-w-xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Registrar Docente</h1>

    <form method="POST" action="{{ route('teachers.store') }}" class="bg-white p-6 rounded-lg shadow">
        @csrf
        <div class="mb-4">
            <label for="prefijo_academico" class="block text-sm font-medium text-gray-700 mb-1">Prefijo académico</label>
            <input type="text" name="prefijo_academico" id="prefijo_academico" value="{{ old('prefijo_academico', '') }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-700" placeholder="Ej: Lic., Ing., M.Sc., Ph.D.">
            @error('prefijo_academico')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="nombre_completo" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
            <input type="text" name="nombre_completo" id="nombre_completo" value="{{ old('nombre_completo', '') }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-700" placeholder="Nombre completo del docente">
            @error('nombre_completo')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3 mt-6">
            <button type="submit" class="px-4 py-2 text-white font-semibold bg-red-700 rounded-lg shadow hover:bg-red-800 transition">
                Guardar
            </button>
            <a href="{{ route('teachers.index') }}" class="px-4 py-2 text-gray-700 font-semibold bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection