@extends('layouts.app')

@section('title', 'Docentes')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Docentes</h1>
        <a href="{{ route('teachers.create') }}" class="px-4 py-2 text-white font-semibold bg-red-700 rounded-lg shadow hover:bg-red-800 transition">
            + Nuevo
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full text-sm text-left">
            <thead class="text-white bg-red-800">
                <tr>
                    <th class="px-4 py-3">Prefijo académico</th>
                    <th class="px-4 py-3">Nombre completo</th>
                    <th class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($teachers as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $item->prefijo_academico }}</td>
                        <td class="px-4 py-3">{{ $item->nombre_completo }}</td>
                        <td class="px-4 py-3 flex gap-2">
                            <form method="POST" action="{{ route('teachers.destroy', $item) }}" onsubmit="return confirm('¿Eliminar este docente?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 text-xs text-white bg-red-600 rounded hover:bg-red-700">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-8 text-center text-gray-500">No hay docentes registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $teachers->links() }}
    </div>
</div>
@endsection