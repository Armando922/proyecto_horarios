@extends('layouts.app')

@section('title', 'Aulas')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Aulas</h1>
        <a href="{{ route('classrooms.create') }}" class="px-4 py-2 text-white font-semibold bg-red-700 rounded-lg shadow hover:bg-red-800 transition">
            + Nueva
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
                    <th class="px-4 py-3">Código</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($classrooms as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $item->codigo }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-8 text-center text-gray-500">No hay aulas registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $classrooms->links() }}
    </div>
</div>
@endsection
