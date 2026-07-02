@extends('layouts.app')

@section('title', 'Auditoría')

@section('content')
<div class="p-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Historial de Auditoría
        </h1>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">

        <table class="w-full text-sm text-left">

            <thead class="text-white bg-red-800">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Usuario</th>
                    <th class="px-4 py-3">Módulo</th>
                    <th class="px-4 py-3">Acción</th>
                    <th class="px-4 py-3">Descripción</th>
                    <th class="px-4 py-3">IP</th>
                    <th class="px-4 py-3">Fecha</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

                @forelse($audits as $audit)

                    <tr class="hover:bg-gray-50">

                        <td class="px-4 py-3">
                            {{ $audit->id }}
                        </td>

                        <td class="px-4 py-3">
                            {{ optional($audit->user)->name ?? 'Sistema' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $audit->modulo }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $audit->accion }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $audit->descripcion }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $audit->ip }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $audit->created_at }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center py-6">
                            No existen registros de auditoría.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-5">
        {{ $audits->links() }}
    </div>

</div>
@endsection