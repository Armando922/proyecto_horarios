@extends('layouts.app')

@section('title', 'Detalle: Materia')

@section('content')

<div class="max-w-5xl mx-auto space-y-8">

    {{-- Información de la materia --}}
    <div class="bg-white rounded-xl shadow p-6">
            <hr class="my-8">
            <h2 class="text-xl font-bold mb-4">Prerrequisitos</h2>

            <h1 class="text-2xl font-bold text-slate-800 mb-6">
                Detalle de Materia
            </h1>
        @if ($errors->has('prerequisite_subject_id'))
            <div class="mb-4 rounded-lg bg-red-100 border border-red-300 text-red-700 px-4 py-3">
                {{ $errors->first('prerequisite_subject_id') }}
            </div>
        @endif

        <form action="{{ route('subjects.prerequisites.store', $subject) }}"
            method="POST"
            class="mb-6 bg-gray-50 p-4 rounded-lg border">

            @csrf

            <div class="flex gap-4 items-end">

                <div class="flex-1">

                    <label class="block text-sm font-semibold mb-2">
                        Agregar prerrequisito
                    </label>

                    <select
                        name="prerequisite_subject_id"
                        class="w-full border rounded-lg px-3 py-2">

                        @foreach($availableSubjects as $available)

                            <option value="{{ $available->id }}">

                                {{ $available->sigla }}
                                -
                                {{ $available->nombre }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                    Agregar

                </button>

            </div>

        </form>
        <table class="min-w-full border rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-2 text-left">Sigla</th>
                    <th class="px-3 py-2 text-left">Nombre</th>
                    <th class="px-3 py-2 text-center">Acción</th>
                </tr>
            </thead>

            <tbody>

                @forelse($subject->prerequisites as $prerequisite)

                    <tr class="border-t">

                        <td class="px-3 py-2">
                            {{ $prerequisite->sigla }}
                        </td>

                        <td class="px-3 py-2">
                            {{ $prerequisite->nombre }}
                        </td>

                        <td class="px-3 py-2 text-center">

                            <form
                                action="{{ route('subjects.prerequisites.destroy', [$subject, $prerequisite]) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">

                                    Eliminar

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3" class="text-center py-4 text-gray-500">

                            No existen prerrequisitos registrados.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        <div class="grid grid-cols-2 gap-6">

            <div>
                <p class="text-xs uppercase text-slate-400">Sigla</p>
                <p class="text-lg font-semibold">{{ $subject->sigla }}</p>
            </div>

            <div>
                <p class="text-xs uppercase text-slate-400">Nombre</p>
                <p class="text-lg font-semibold">{{ $subject->nombre }}</p>
            </div>

            <div>
                <p class="text-xs uppercase text-slate-400">Creado</p>
                <p>{{ $subject->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <div>
                <p class="text-xs uppercase text-slate-400">Actualizado</p>
                <p>{{ $subject->updated_at->format('d/m/Y H:i') }}</p>
            </div>

        </div>

    </div>


    {{-- Prerrequisitos --}}
    <div class="bg-white rounded-xl shadow p-6">

        <div class="flex justify-between items-center mb-5">

            <h2 class="text-xl font-bold">
                Prerrequisitos
            </h2>

        </div>

        @if($subject->prerequisites->isEmpty())

            <div class="rounded-lg bg-slate-100 p-4 text-slate-500">
                Esta materia no tiene prerrequisitos registrados.
            </div>

        @else

            <table class="w-full border-collapse">

                <thead>

                    <tr class="border-b">

                        <th class="text-left py-3">
                            Sigla
                        </th>

                        <th class="text-left py-3">
                            Materia
                        </th>

                        <th class="text-center py-3">
                            Acción
                        </th>

                    </tr>

                </thead>

                <tbody>

                @foreach($subject->prerequisites as $prerequisite)

                    <tr class="border-b">

                        <td class="py-3">
                            {{ $prerequisite->sigla }}
                        </td>

                        <td>
                            {{ $prerequisite->nombre }}
                        </td>

                        <td class="text-center">

                            <form method="POST">

                                @csrf

                                @method('DELETE')

                                <button
                                    class="px-3 py-2 rounded bg-red-600 text-white hover:bg-red-700">

                                    Eliminar

                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        @endif

    </div>


    {{-- Agregar prerrequisito --}}
    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-xl font-bold mb-5">

            Agregar prerrequisito

        </h2>

        <form method="POST">

            @csrf

            <div class="flex gap-4">

                <select
                    name="prerequisite_subject_id"
                    class="flex-1 border rounded-lg px-4 py-2">

                    @foreach($availableSubjects as $available)

                        <option value="{{ $available->id }}">

                            {{ $available->sigla }}
                            -
                            {{ $available->nombre }}

                        </option>

                    @endforeach

                </select>

                <button
                    class="bg-blue-600 text-white px-6 rounded-lg hover:bg-blue-700">

                    Agregar

                </button>

            </div>

        </form>

    </div>


    <div class="flex gap-3">

        <a
            href="{{ route('subjects.edit',$subject) }}"
            class="px-4 py-2 bg-yellow-600 text-white rounded-lg">

            Editar

        </a>

        <a
            href="{{ route('subjects.index') }}"
            class="px-4 py-2 bg-slate-300 rounded-lg">

            Volver

        </a>

    </div>

</div>

@endsection