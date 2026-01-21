<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comunidad Laravel</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 text-gray-800 font-sans">

    <nav class="bg-white shadow-md p-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold text-indigo-600">MiComunidad</div>
            
            <div>
                @if (Route::has('login'))
                    <div class="space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-indigo-600 font-semibold">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-semibold">Iniciar Sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">Registrarse</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <header class="bg-indigo-700 text-white py-20 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">Bienvenido a la Comunidad</h1>
        <p class="text-lg md:text-xl opacity-90">Enterate de las últimas noticias y participa en nuestros eventos.</p>
    </header>

    <div class="max-w-7xl mx-auto p-6 space-y-12">
        
        <section>
            <h2 class="text-3xl font-bold mb-6 border-l-4 border-indigo-500 pl-4">📰 Noticias Destacadas</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($destacados as $noticia)
                    <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="h-48 bg-gray-300 w-full flex items-center justify-center text-gray-500">
                            @if($noticia->image_path)
                                <img src="{{ asset('storage/' . $noticia->image_path) }}" class="w-full h-full object-cover">
                            @else
                                <span>Sin Imagen</span>
                            @endif
                        </div>
                        
                        <div class="p-5">
                            <span class="text-xs font-bold uppercase text-indigo-600 tracking-wide">{{ $noticia->category->name ?? 'General' }}</span>
                            <h3 class="mt-2 text-xl font-semibold leading-tight text-gray-900">{{ $noticia->title }}</h3>
                            <p class="mt-2 text-gray-600 line-clamp-3">{{ $noticia->excerpt }}</p>
                            <a href="#" class="mt-4 inline-block text-indigo-600 hover:underline">Leer más &rarr;</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section>
            <h2 class="text-3xl font-bold mb-6 border-l-4 border-green-500 pl-4">📅 Próximos Eventos</h2>
            <div class="space-y-4">
                @foreach($proximosEventos as $evento)
                    <div class="flex flex-col md:flex-row bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:border-green-300 transition">
                        
                        <div class="bg-green-100 text-green-800 w-full md:w-32 flex flex-col items-center justify-center p-4">
                            <span class="text-3xl font-bold">{{ $evento->eventDetails->start_date->format('d') }}</span>
                            <span class="uppercase text-sm font-bold">{{ $evento->eventDetails->start_date->translatedFormat('M') }}</span>
                            <span class="text-xs">{{ $evento->eventDetails->start_date->format('H:i') }} hrs</span>
                        </div>

                        <div class="p-6 flex-1 flex flex-col justify-center">
                            <h3 class="text-xl font-bold text-gray-800">{{ $evento->title }}</h3>
                            <div class="flex items-center text-gray-500 mt-2 space-x-4 text-sm">
                                <span>📍 {{ $evento->eventDetails->location }}</span>
                                <span>👥 Cupos: {{ $evento->registrations->count() }} / {{ $evento->eventDetails->max_attendees ?? '∞' }}</span>
                            </div>
                        </div>

                        <div class="p-6 flex items-center justify-center bg-gray-50">
                            <button class="bg-green-600 text-white px-6 py-2 rounded-full font-bold shadow hover:bg-green-700 transition transform hover:-translate-y-1">
                                Inscribirme
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

    </div>

    <footer class="bg-gray-800 text-white py-8 mt-12 text-center">
        <p>&copy; 2026 Plataforma de Eventos. Desarrollado con Laravel 11.</p>
    </footer>
</body>
</html>