<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Universidad') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    
    <!-- Sidebar para usuarios autenticados -->
    @auth
    <div id="sidebar" class="fixed right-0 top-0 h-full w-80 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out z-50">
        <div class="p-6 h-full flex flex-col">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Mi Menú</h2>
                <button onclick="toggleSidebar()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- User Info -->
            <div class="mb-6 pb-6 border-b">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold text-lg">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                @role('estudiante')
                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                    👨‍🎓 Estudiante
                </span>
                @endrole
                @role('docente')
                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                    👨‍🏫 Docente
                </span>
                @endrole
                @role('admin|dev')
                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                    👑 Administrador
                </span>
                @endrole
            </div>

            <!-- Menu -->
            <nav class="flex-1 space-y-2">
                @role('estudiante')
                <!-- Mis Eventos Registrados -->
                <a href="{{ route('student.events.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Mis Eventos</span>
                    </div>
                </a>
                
                <!-- Solicitud de Docente -->
                @php
                    $userRequest = \App\Models\RoleRequest::where('user_id', auth()->id())
                        ->latest()
                        ->first();
                @endphp
                
                @if($userRequest)
                    <!-- Tiene solicitud - mostrar estado -->
                    <a href="{{ route('student.role-request.show') }}" class="block px-4 py-3 rounded-lg transition
                        {{ $userRequest->status === 'pending' ? 'bg-yellow-50 text-yellow-800 hover:bg-yellow-100' : '' }}
                        {{ $userRequest->status === 'approved' ? 'bg-green-50 text-green-800 hover:bg-green-100' : '' }}
                        {{ $userRequest->status === 'rejected' ? 'bg-red-50 text-red-800 hover:bg-red-100' : '' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <span class="block font-medium">Solicitud Docente</span>
                                <span class="text-xs">
                                    @if($userRequest->status === 'pending')
                                        ⏳ Pendiente
                                    @elseif($userRequest->status === 'approved')
                                        ✅ Aprobada - Completar perfil
                                    @else
                                        ❌ Rechazada
                                    @endif
                                </span>
                            </div>
                        </div>
                    </a>
                @else
                    <!-- No tiene solicitud - mostrar opción de solicitar -->
                    <a href="{{ route('student.role-request.create') }}" class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span>Ser Docente</span>
                        </div>
                    </a>
                @endif
                @endrole

                @role('docente')
                <a href="{{ route('teacher.events.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Gestionar Eventos</span>
                    </div>
                </a>
                @endrole

                @role('admin|dev')
                <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Panel Admin</span>
                    </div>
                </a>
                @endrole

                <!-- Perfil -->
                <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>Mi Perfil</span>
                    </div>
                </a>
            </nav>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full px-4 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </div>

    <!-- Overlay -->
    <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40"></div>

    <!-- Toggle Button (Floating) -->
    <button onclick="toggleSidebar()" class="fixed right-6 top-6 z-30 bg-indigo-600 hover:bg-indigo-700 text-white p-3 rounded-full shadow-lg transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
    @endauth

    <!-- Hero Header -->
    <header class="bg-gradient-to-r from-indigo-700 via-purple-700 to-pink-600 text-white py-20 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">Bienvenido a la Comunidad</h1>
        <p class="text-lg md:text-xl opacity-90">Entérate de las últimas noticias y participa en nuestros eventos.</p>
        
        @guest
        <div class="mt-8 space-x-4">
            <a href="{{ route('login') }}" class="bg-white text-indigo-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition inline-block">
                Iniciar Sesión
            </a>
            <a href="{{ route('register') }}" class="bg-indigo-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-900 transition inline-block border-2 border-white">
                Registrarse
            </a>
        </div>
        @endguest
    </header>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto p-6 space-y-12">
        
        <!-- Noticias Destacadas -->
        <section>
            <h2 class="text-3xl font-bold mb-6 border-l-4 border-indigo-500 pl-4">📰 Noticias Destacadas</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($destacados as $noticia)
                    <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="h-48 bg-gray-300 w-full flex items-center justify-center text-gray-500">
                            @if($noticia->image_path)
                                <img src="{{ asset('storage/' . $noticia->image_path) }}" class="w-full h-full object-cover" alt="{{ $noticia->title }}">
                            @else
                                <span>Sin Imagen</span>
                            @endif
                        </div>
                        <div class="p-4">
                            <span class="text-xs text-indigo-600 font-semibold">{{ $noticia->category->name }}</span>
                            <h3 class="text-xl font-bold mt-1 mb-2">{{ $noticia->title }}</h3>
                            <p class="text-gray-600 text-sm">{{ Str::limit($noticia->excerpt, 100) }}</p>
                            <a href="#" class="text-indigo-600 hover:underline mt-2 inline-block">Leer más →</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <!-- Eventos Próximos -->
        <section>
            <h2 class="text-3xl font-bold mb-6 border-l-4 border-pink-500 pl-4">🎉 Próximos Eventos</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($eventos as $evento)
                    <article class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-pink-100 text-pink-800 text-xs font-semibold px-3 py-1 rounded-full">EVENTO</span>
                            <span class="text-sm text-gray-500">{{ $evento->eventDetails->start_date->format('d M Y') }}</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">{{ $evento->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($evento->excerpt, 150) }}</p>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $evento->eventDetails->location }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span>{{ $evento->eventDetails->max_attendees > 0 ? 'Cupo: ' . $evento->eventDetails->max_attendees : 'Cupo ilimitado' }}</span>
                            </div>
                        </div>
                        @auth
                        <a href="{{ route('student.events.index') }}" class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg inline-block transition">
                            Ver Detalles
                        </a>
                        @else
                        <p class="mt-4 text-sm text-gray-500">Inicia sesión para registrarte</p>
                        @endauth
                    </article>
                @endforeach
            </div>
        </section>

    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-12">
        <p>&copy; 2026 {{ config('app.name') }}. Todos los derechos reservados.</p>
    </footer>

    <!-- Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            
            sidebar.classList.toggle('translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>

</body>
</html>