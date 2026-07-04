@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 space-y-8">

    @if (session('success'))
        <div class="flex items-center justify-between px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-2xl">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="font-bold hover:text-green-900">&times;</button>
        </div>
    @endif

    @if ($errors->any())
        <div class="px-4 py-3 bg-red-100 border border-red-300 text-red-800 rounded-2xl">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="relative bg-white rounded-3xl shadow-2xl shadow-red-100 border border-gray-100 overflow-hidden">
        <div class="px-8 py-8">
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight mb-1">Editar Perfil</h2>
            <p class="text-red-600 font-medium mb-6">Actualiza tus datos personales</p>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Nombre</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autocomplete="given-name"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-300 @error('name') border-red-400 @enderror">
                    @error('name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="lastname" class="block text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Apellido</label>
                    <input type="text" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}" required autocomplete="family-name"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-300 @error('lastname') border-red-400 @enderror">
                    @error('lastname')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Correo Electrónico</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-300 @error('email') border-red-400 @enderror">
                    @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-wrap gap-4 pt-2">
                    <button type="submit" class="flex-1 min-w-[180px] bg-red-800 hover:bg-red-900 text-white py-4 rounded-2xl font-bold transition-all shadow-lg shadow-red-200">
                        Guardar Cambios
                    </button>
                    <a href="{{ route('profile.index') }}" class="flex-1 min-w-[180px] text-center bg-white border-2 border-gray-200 hover:border-red-300 hover:bg-red-50 text-gray-700 py-4 rounded-2xl font-bold transition-all">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div id="password" class="relative bg-white rounded-3xl shadow-2xl shadow-red-100 border border-gray-100 overflow-hidden">
        <div class="px-8 py-8">
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight mb-1">Cambiar Contraseña</h2>
            <p class="text-red-600 font-medium mb-6">Usa una contraseña de al menos 8 caracteres</p>

            <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Contraseña Actual</label>
                    <input type="password" id="current_password" name="current_password" required autocomplete="current-password"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-300 @error('current_password') border-red-400 @enderror">
                    @error('current_password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Nueva Contraseña</label>
                    <input type="password" id="password" name="password" required autocomplete="new-password" minlength="8"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-300 @error('password') border-red-400 @enderror">
                    @error('password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Confirmar Nueva Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" minlength="8"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-300">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-red-800 hover:bg-red-900 text-white py-4 rounded-2xl font-bold transition-all shadow-lg shadow-red-200">
                        Actualizar Contraseña
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection