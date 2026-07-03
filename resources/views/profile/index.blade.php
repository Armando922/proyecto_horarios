@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6">

    <div class="relative bg-white rounded-3xl shadow-2xl shadow-red-100 border border-gray-100 overflow-hidden">
        <div class="h-32 bg-gradient-to-r from-red-900 via-red-700 to-red-600"></div>

        <div class="px-8 pb-8">
            <div class="relative -mt-16 mb-6">
                <div class="w-32 h-32 bg-white rounded-full p-2 shadow-xl shadow-red-200">
                    <div class="w-full h-full bg-gradient-to-br from-red-50 to-red-100 rounded-full flex items-center justify-center text-3xl font-bold text-red-900 uppercase select-none">
                        {{ mb_substr($user->name, 0, 1) }}{{ mb_substr($user->lastname ?? '', 0, 1) }}
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    {{ $user->name }} {{ $user->lastname }}
                </h2>
                <p class="text-red-600 font-medium">Perfil de Usuario</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 hover:border-red-200 transition">
                    <label class="block text-[10px] uppercase font-bold text-gray-400 tracking-widest">Correo Electrónico</label>
                    <p class="text-gray-700 font-medium mt-1 break-all">{{ $user->email }}</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 hover:border-red-200 transition">
                    <label class="block text-[10px] uppercase font-bold text-gray-400 tracking-widest">Rol del Sistema</label>
                    @if($user->rol)
                        <span class="inline-block px-3 py-1 bg-red-100 text-red-800 text-sm font-bold rounded-lg mt-1">
                            {{ ucfirst($user->rol) }}
                        </span>
                    @else
                        <span class="inline-block px-3 py-1 bg-gray-200 text-gray-600 text-sm font-bold rounded-lg mt-1 italic">
                            Sin asignar
                        </span>
                    @endif
                </div>

                <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 hover:border-red-200 transition col-span-1 md:col-span-2">
                    <label class="block text-[10px] uppercase font-bold text-gray-400 tracking-widest">Registrado el</label>
                    <p class="text-gray-700 font-medium mt-1">
                        {{ $user->created_at?->format('d/m/Y') ?? 'N/A' }}
                    </p>
                </div>
            </div>

            <div class="mt-10 flex flex-wrap gap-4">
                <a href="{{ route('profile.edit') }}" class="flex-1 min-w-[200px] text-center bg-red-800 hover:bg-red-900 text-white py-4 rounded-2xl font-bold transition-all transform hover:scale-[1.02] shadow-lg shadow-red-200">
                    Editar Perfil
                </a>
                <a href="{{ route('profile.edit') }}#password" class="flex-1 min-w-[200px] text-center bg-white border-2 border-gray-200 hover:border-red-300 hover:bg-red-50 text-gray-700 py-4 rounded-2xl font-bold transition-all transform hover:scale-[1.02]">
                    Cambiar Contraseña
                </a>
            </div>
        </div>
    </div>
</div>
@endsection