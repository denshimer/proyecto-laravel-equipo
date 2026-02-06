<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'SICI-ISI') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700&family=Inter:wght@400;600&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-sici-dark text-sici-light font-sans antialiased">
        <div class="flex h-screen bg-sici-dark overflow-hidden">

            <!-- Sidebar -->
            <aside class="w-64 flex-shrink-0 bg-sici-card border-r border-gray-800 hidden md:flex flex-col">
                <div class="h-16 flex items-center justify-center border-b border-gray-800">
                    <span class="text-sici-red font-display font-bold text-2xl tracking-wider">SICI ADMIN</span>
                </div>
                
                
                <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                    <!-- Volver al Inicio -->
                    <a href="{{ route('welcome') }}" class="flex items-center px-4 py-2 text-gray-400 hover:text-white hover:bg-gray-800/50 rounded-lg transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Volver al Inicio
                    </a>

                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('dashboard') ? 'text-white bg-sici-red shadow-lg shadow-red-900/20' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }} rounded-lg transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Panel Principal
                    </a>

                    @if(Auth::user()->hasRole(['admin', 'dev']))
                        <!-- ADMIN/DEV NAVIGATION -->
                        <div class="pt-4 pb-2">
                            <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Gestión</p>
                        </div>

                        <!-- Publicaciones -->
                        <a href="{{ route('admin.posts.index') }}" class="flex items-center px-4 py-2 {{ request()->routeIs('admin.posts.*') ? 'text-white bg-gray-800' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }} rounded-lg transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            Publicaciones
                        </a>

                        <!-- Usuarios -->
                        <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 {{ request()->routeIs('admin.users.*') ? 'text-white bg-gray-800' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }} rounded-lg transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Usuarios
                        </a>

                        <!-- Solicitudes de Rol -->
                        <a href="{{ route('admin.role-requests.index') }}" class="flex items-center px-4 py-2 {{ request()->routeIs('admin.role-requests.*') ? 'text-white bg-gray-800' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }} rounded-lg transition relative">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                            Solicitudes de Rol
                            @php
                                $pendingCount = \App\Models\RoleRequest::where('status', 'pending')->count();
                            @endphp
                            @if($pendingCount > 0)
                                <span class="ml-auto bg-red-600 text-white px-2 py-0.5 rounded-full text-xs font-bold">{{ $pendingCount }}</span>
                            @endif
                        </a>

                        <div class="pt-4 pb-2">
                            <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Papelera</p>
                        </div>

                        <!-- Papelera Publicaciones -->
                        <a href="{{ route('admin.posts.trash') }}" class="flex items-center px-4 py-2 text-gray-400 hover:text-white hover:bg-gray-800/50 rounded-lg transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Publicaciones
                        </a>

                        <!-- Papelera Usuarios -->
                        <a href="{{ route('admin.users.trash') }}" class="flex items-center px-4 py-2 text-gray-400 hover:text-white hover:bg-gray-800/50 rounded-lg transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Usuarios
                        </a>

                    @elseif(Auth::user()->hasRole('docente'))
                        <!-- TEACHER NAVIGATION -->
                        <div class="pt-4 pb-2">
                            <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Mis Eventos</p>
                        </div>

                        <!-- Mis Eventos -->
                        <a href="{{ route('teacher.events.index') }}" class="flex items-center px-4 py-2 {{ request()->routeIs('teacher.events.*') ? 'text-white bg-gray-800' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }} rounded-lg transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Gestionar Eventos
                        </a>

                        <!-- Crear Evento -->
                        <a href="{{ route('teacher.events.create') }}" class="flex items-center px-4 py-2 text-gray-400 hover:text-white hover:bg-gray-800/50 rounded-lg transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Crear Nuevo Evento
                        </a>

                    @elseif(Auth::user()->hasRole('estudiante'))
                        <!-- STUDENT NAVIGATION -->
                        <div class="pt-4 pb-2">
                            <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Eventos</p>
                        </div>

                        <!-- Explorar Eventos -->
                        <a href="{{ route('student.events.index') }}" class="flex items-center px-4 py-2 {{ request()->routeIs('student.events.*') ? 'text-white bg-gray-800' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }} rounded-lg transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            Explorar Eventos
                        </a>

                        <!-- Mis Inscripciones -->
                        <a href="{{ route('student.registrations.index') }}" class="flex items-center px-4 py-2 {{ request()->routeIs('student.registrations.*') ? 'text-white bg-gray-800' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }} rounded-lg transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            Mis Inscripciones
                        </a>

                        @php
                            $hasRoleRequest = \App\Models\RoleRequest::where('user_id', Auth::id())->exists();
                        @endphp

                        @if(!$hasRoleRequest)
                            <div class="pt-4 pb-2">
                                <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Solicitud</p>
                            </div>

                            <!-- Solicitar ser Docente -->
                            <a href="{{ route('student.role-request.create') }}" class="flex items-center px-4 py-2 text-gray-400 hover:text-white hover:bg-gray-800/50 rounded-lg transition">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                                Solicitar ser Docente
                            </a>
                        @endif
                    @endif
                </nav>

                
                <div class="p-4 border-t border-gray-800">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full bg-sici-red flex items-center justify-center text-white font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">
                                @if(Auth::user()->hasRole(['admin', 'dev']))
                                    Administrador
                                @elseif(Auth::user()->hasRole('docente'))
                                    Docente
                                @else
                                    Estudiante
                                @endif
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="w-full flex items-center justify-center px-4 py-2 mb-2 text-xs font-bold text-gray-400 border border-gray-700 rounded hover:bg-gray-800/50 hover:text-white transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Mi Perfil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-xs font-bold text-red-500 border border-red-500/30 rounded hover:bg-red-500/10 transition">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-sici-dark relative">
                <header class="bg-sici-card/50 backdrop-blur-md border-b border-gray-800 p-4 sticky top-0 z-10 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-white">{{ $header ?? 'Panel de Control' }}</h2>
                </header>

                <div class="p-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
