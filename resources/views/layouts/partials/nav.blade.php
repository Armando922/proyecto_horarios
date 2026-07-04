<nav id="main-nav" class="hidden md:flex md:items-center w-full md:w-auto mt-3 md:mt-0">
    <ul class="flex flex-col md:flex-row md:space-x-2 text-sm font-medium space-y-1 md:space-y-0">

        <li>
            <a href="{{ url('/') }}"
               class="block px-3 py-1.5 rounded-lg transition {{ request()->is('/') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">
                Escritorio
            </a>
        </li>

        <li>
            <a href="{{ route('saved-schedules.index') }}"
               class="block px-3 py-1.5 rounded-lg transition {{ request()->routeIs('saved-schedules.*') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">
                Mis Horarios
            </a>
        </li>

        <li>
            <a href="{{ route('schedule.grid') }}"
               class="block px-3 py-1.5 rounded-lg transition {{ request()->routeIs('schedule.grid') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">
                Horario General
            </a>
        </li>

        <li>
            <a href="{{ route('subjects.index') }}"
               class="block px-3 py-1.5 rounded-lg transition {{ request()->routeIs('subjects.*') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">
                Materias
            </a>
        </li>

        <li>
            <a href="{{ url('/groups') }}"
               class="block px-3 py-1.5 rounded-lg transition {{ request()->is('groups*') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">
                Grupos
            </a>
        </li>

        <li>
            <a href="{{ url('/perfil') }}"
               class="block px-3 py-1.5 rounded-lg transition {{ request()->is('perfil') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">
                Perfil
            </a>
        </li>

    </ul>
</nav>
