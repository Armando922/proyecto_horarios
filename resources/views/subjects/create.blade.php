@extends('layouts.app')

@section('title', 'Nueva: Materia')

@section('content')
<div class="p-6 max-w-xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Registrar Materia</h1>

    <form method="POST" action="{{ route('subjects.store') }}" class="bg-white p-6 rounded-lg shadow">
        @csrf
        <div class="mb-4">
            <label for="sigla" class="block text-sm font-medium text-gray-700 mb-1">Sigla</label>
            <input type="text" name="sigla" id="sigla" value="{{ old('sigla', '') }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-700" placeholder="Ej: INF101">
            @error('sigla')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', '') }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-700" placeholder="Nombre de la materia">
            @error('nombre')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3 mt-6">
            <button type="submit" class="px-4 py-2 text-white font-semibold bg-red-700 rounded-lg shadow hover:bg-red-800 transition">
                Guardar
            </button>
            <a href="{{ route('subjects.index') }}" class="px-4 py-2 text-gray-700 font-semibold bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
