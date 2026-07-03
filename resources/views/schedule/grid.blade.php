@extends('layouts.app')

@section('title', 'Horario General')

@php
    $dias = [1 => 'Lunes', 2 => 'Martes', 3 => 'Miercoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sabado', 7 => 'Domingo'];
    $horas = collect($grid)->flatMap(fn ($porHora) => array_keys($porHora))->unique()->sort()->values();
    $palettes = [
        ['bg' => 'bg-blue-50', 'border' => 'border-blue-200', 'text' => 'text-blue-800', 'badge' => 'bg-blue-600'],
        ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-200', 'text' => 'text-emerald-800', 'badge' => 'bg-emerald-600'],
        ['bg' => 'bg-amber-50', 'border' => 'border-amber-200', 'text' => 'text-amber-800', 'badge' => 'bg-amber-600'],
        ['bg' => 'bg-violet-50', 'border' => 'border-violet-200', 'text' => 'text-violet-800', 'badge' => 'bg-violet-600'],
        ['bg' => 'bg-rose-50', 'border' => 'border-rose-200', 'text' => 'text-rose-800', 'badge' => 'bg-rose-600'],
        ['bg' => 'bg-cyan-50', 'border' => 'border-cyan-200', 'text' => 'text-cyan-800', 'badge' => 'bg-cyan-600'],
        ['bg' => 'bg-orange-50', 'border' => 'border-orange-200', 'text' => 'text-orange-800', 'badge' => 'bg-orange-600'],
        ['bg' => 'bg-teal-50', 'border' => 'border-teal-200', 'text' => 'text-teal-800', 'badge' => 'bg-teal-600'],
    ];
    function subjectColor($sigla, $palettes) {
        $idx = crc32($sigla) % count($palettes);
        return $palettes[abs($idx)];
    }
@endphp

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="font-display text-2xl font-bold text-slate-800">Horario General</h1>
            <p class="text-slate-500 text-sm mt-0.5">Explora todas las clases programadas por día y hora.</p>
        </div>
        @if ($horas->isNotEmpty())
            <a href="{{ route('schedule.print') }}" target="_blank"
               class="inline-flex items-center gap-2 self-start rounded-xl bg-slate-800 text-white text-sm font-semibold px-4 py-2.5 hover:bg-slate-900 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                </svg>
                Imprimir
            </a>
        @endif
    </div>

    <form method="GET" action="{{ route('schedule.grid') }}"
          class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4 sm:p-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Especialidad</label>
                <select name="specialty_id"
                        class="w-full rounded-lg border-slate-300 text-sm focus:border-slate-500 focus:ring-slate-500 transition">
                    <option value="">Todas</option>
                    @foreach ($specialties as $specialty)
                        <option value="{{ $specialty->id }}" @selected(request('specialty_id') == $specialty->id)>{{ $specialty->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Semestre</label>
                <select name="semester_id"
                        class="w-full rounded-lg border-slate-300 text-sm focus:border-slate-500 focus:ring-slate-500 transition">
                    <option value="">Todos</option>
                    @foreach ($semesters as $semester)
                        <option value="{{ $semester->id }}" @selected(request('semester_id') == $semester->id)>{{ $semester->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Docente</label>
                <select name="teacher_id"
                        class="w-full rounded-lg border-slate-300 text-sm focus:border-slate-500 focus:ring-slate-500 transition">
                    <option value="">Todos</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" @selected(request('teacher_id') == $teacher->id)>{{ $teacher->nombre_completo }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Grupo</label>
                <select name="group_id"
                        class="w-full rounded-lg border-slate-300 text-sm focus:border-slate-500 focus:ring-slate-500 transition">
                    <option value="">Todos</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}" @selected(request('group_id') == $group->id)>{{ $group->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit"
                        class="w-full rounded-xl bg-slate-800 text-white text-sm font-semibold px-4 py-2.5 hover:bg-slate-900 transition shadow-sm">
                    Filtrar
                </button>
            </div>
        </div>
    </form>

    @if ($horas->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-12 text-center">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <p class="text-slate-500 font-medium">No hay clases que coincidan con los filtros seleccionados.</p>
            <a href="{{ route('schedule.grid') }}" class="text-sm text-slate-600 underline hover:text-slate-800 mt-1 inline-block">Limpiar filtros</a>
        </div>
    @else
        {{-- Mobile: card-based day layout --}}
        <div class="block md:hidden space-y-4">
            @foreach ($dias as $diaNum => $diaNombre)
                @php
                    $clasesDelDia = collect($horas)->flatMap(fn ($hora) => $grid[$diaNum][$hora] ?? []);
                @endphp
                @if ($clasesDelDia->isNotEmpty())
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                        <div class="bg-slate-800 text-white px-4 py-3 font-display font-bold text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            {{ $diaNombre }}
                        </div>
                        <div class="divide-y divide-slate-100">
                            @foreach ($horas as $hora)
                                @if (isset($grid[$diaNum][$hora]))
                                    @foreach ($grid[$diaNum][$hora] as $class)
                                        @php $palette = subjectColor($class->subject->sigla, $palettes); @endphp
                                        <div class="px-4 py-3 flex items-start gap-3">
                                            <div class="shrink-0 w-16 text-xs font-semibold text-slate-500 pt-0.5 text-right tabular-nums">{{ $hora }}</div>
                                            <div class="min-w-0 flex-1 {{ $palette['bg'] }} {{ $palette['border'] }} border rounded-xl px-3 py-2.5">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <span class="{{ $palette['badge'] }} text-white text-[10px] font-bold px-1.5 py-0.5 rounded">{{ $class->subject->sigla }}</span>
                                                    <span class="text-xs font-semibold {{ $palette['text'] }} truncate">{{ $class->subject->nombre }}</span>
                                                </div>
                                                <div class="text-xs text-slate-500 space-y-0.5">
                                                    <p>{{ $class->teacher->prefijo_academico ?? '' }} {{ $class->teacher->nombre_completo }}</p>
                                                    <p>{{ $class->classroom->codigo }} &middot; {{ $class->group->nombre }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        {{-- Desktop: full grid table --}}
        <div class="hidden md:block overflow-x-auto bg-white rounded-2xl shadow-sm border border-slate-200">
            <table class="w-full text-sm border-collapse min-w-[700px]">
                <thead>
                    <tr class="bg-slate-800">
                        <th class="px-3 py-3 text-left text-white font-semibold text-xs uppercase tracking-wider border-b border-slate-700 w-20">Hora</th>
                        @foreach ($dias as $diaNum => $diaNombre)
                            <th class="px-3 py-3 text-left text-white font-semibold text-xs uppercase tracking-wider border-b border-slate-700 border-l border-slate-700">
                                {{ $diaNombre }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach ($horas as $hora)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-3 py-2 align-top text-xs font-semibold text-slate-500 whitespace-nowrap border-r border-slate-200">{{ $hora }}</td>
                            @foreach ($dias as $diaNum => $diaNombre)
                                <td class="px-2 py-2 align-top border-l border-slate-200 min-h-[80px]">
                                    @if (isset($grid[$diaNum][$hora]))
                                        @foreach ($grid[$diaNum][$hora] as $class)
                                            @php $palette = subjectColor($class->subject->sigla, $palettes); @endphp
                                            <div class="{{ $palette['bg'] }} {{ $palette['border'] }} border rounded-lg p-2.5 mb-1.5 last:mb-0 shadow-sm hover:shadow-md transition-shadow">
                                                <div class="flex items-center gap-1.5 mb-1">
                                                    <span class="{{ $palette['badge'] }} text-white text-[10px] font-bold px-1.5 py-0.5 rounded leading-tight">{{ $class->subject->sigla }}</span>
                                                </div>
                                                <p class="text-xs font-semibold {{ $palette['text'] }} leading-tight mb-1">{{ $class->subject->nombre }}</p>
                                                <p class="text-[11px] text-slate-500 leading-tight">{{ $class->teacher->nombre_completo }}</p>
                                                <p class="text-[11px] text-slate-400 leading-tight mt-0.5">
                                                    {{ $class->classroom->codigo }}
                                                    @if ($class->group)
                                                        &middot; {{ $class->group->nombre }}
                                                    @endif
                                                    @if ($class->specialty)
                                                        &middot; {{ $class->specialty->nombre }}
                                                    @endif
                                                </p>
                                            </div>
                                        @endforeach
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
