@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 space-y-8">

    @if ($errors->any())
        <div class="px-4 py-3 bg-red-100 text-red-800 rounded-2xl">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="relative bg-white rounded-4xl shadow-2xl shadow-indigo-100 border border-gray-100 overflow-hidden">
        <div class="px-8 py-8">
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight mb-1">Editar Perfil</h2>
            <p class="text-red-500 font-medium mb-6">Actualiza tus datos personales</p>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Nombre</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-200">
                </div>

                <div>
                    <label class="block text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Apellido</label>
                    <input type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-200">
                </div>

                <div>
                    <label class="block text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Correo Electrónico</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-200">
                </div>

                <div class="flex flex-wrap gap-4 pt-2">
                    <button type="submit" class="flex-1 bg-gray-900 hover:bg-gray-800 text-white py-4 rounded-2xl font-bold transition-all">
                        Guardar Cambios
                    </button>
                    <a href="{{ route('profile.index') }}" class="flex-1 text-center bg-white border-2 border-gray-100 hover:border-gray-200 text-gray-700 py-4 rounded-2xl font-bold transition-all">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div id="password" class="relative bg-white rounded-4xl shadow-2xl shadow-indigo-100 border border-gray-100 overflow-hidden">
        <div class="px-8 py-8">
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight mb-1">Cambiar Contraseña</h2>
            <p class="text-red-500 font-medium mb-6">Usa una contraseña de al menos 8 caracteres</p>

            <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Contraseña Actual</label>
                    <input type="password" name="current_password"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-200">
                </div>

                <div>
                    <label class="block text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Nueva Contraseña</label>
                    <input type="password" name="password"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-200">
                </div>

                <div>
                    <label class="block text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Confirmar Nueva Contraseña</label>
                    <input type="password" name="password_confirmation"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-200">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-gray-900 hover:bg-gray-800 text-white py-4 rounded-2xl font-bold transition-all">
                        Actualizar Contraseña
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
