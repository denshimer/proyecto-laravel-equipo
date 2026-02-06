<x-layout title="Inicio | SICI-ISI">

    <header class="relative bg-cover bg-center min-h-[500px] md:h-[600px] flex items-center -mt-16">
        <div class="absolute inset-0 bg-sici-dark/70" style="background-image: url('{{ asset('images/hero-bg.png') }}'); opacity: 0.2;"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-24 md:py-0">
            <div class="max-w-3xl">
                <h2 class="text-sici-red font-bold text-base sm:text-lg md:text-2xl mb-2 tracking-wider">BIENVENIDO A SICI-ISI</h2>
                <h1 class="text-2xl sm:text-3xl md:text-5xl lg:text-6xl font-display font-bold text-white leading-tight mb-4">
                    Sociedad de Investigación, Ciencia e Innovación.<br class="hidden sm:block">
                    <span class="block mt-1">INGENIERÍA DE SISTEMAS INFORMÁTICOS</span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-300 mb-4 md:mb-6">
                    La Sociedad de Ciencia, Investigación e Innovación (SICI) de la carrera de Ingeniería de Sistemas Informáticos es una comunidad de estudiantes y docentes dedicados a explorar y promover el avance tecnológico.
                </p>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-300 mb-6 md:mb-8">
                    Un espacio dedicado a la vanguardia tecnológica y el desarrollo académico en la carrera de Ingeniería de Sistemas Informáticos.
                </p>
                <a href="{{ route('about') }}" class="inline-block bg-sici-red hover:bg-sici-redDark text-white px-6 sm:px-8 py-2 sm:py-3 rounded font-semibold text-base sm:text-lg transition">
                    Conoce más
                </a>
            </div>
        </div>
    </header>

    <section class="py-12 md:py-20 bg-sici-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-display font-semibold text-white mb-8 md:mb-10 text-center">Publicaciones y Eventos Recientes</h2>

            @if($destacados->isNotEmpty() || $eventos->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                @foreach ($destacados as $noticia)
                <div class="bg-sici-card rounded-lg overflow-hidden border border-gray-800 group hover:border-sici-red transition duration-300 flex flex-col">
                    <div class="h-48 overflow-hidden">
                        @if($noticia->image_path)
                            <img src="{{ asset('storage/' . $noticia->image_path) }}" alt="Imagen de la publicación" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <img src="{{ asset('images/card.jpeg') }}" alt="Imagen de la publicación" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @endif
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-white mb-2 flex-grow">
                            <span class="text-sici-red">Publicación:</span><br>{{ $noticia->title }}
                        </h3>
                        <p class="text-sici-muted text-sm mb-4 font-mono">{{ $noticia->created_at->format('d M Y') }}</p>
                        <a href="{{ route('publications.show', $noticia) }}" class="text-sici-red font-bold text-sm tracking-wide hover:underline flex items-center mt-auto">
                            Leer más <span class="ml-1">&gt;</span>
                        </a>
                    </div>
                </div>
                @endforeach

                @foreach ($eventos as $evento)
                <div class="bg-sici-card rounded-lg overflow-hidden border border-gray-800 group hover:border-sici-red transition duration-300 flex flex-col">
                    <div class="h-48 overflow-hidden">
                        @if($evento->image_path)
                            <img src="{{ asset('storage/' . $evento->image_path) }}" alt="Imagen del evento" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <img src="{{ asset('images/card.jpeg') }}" alt="Imagen del evento" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @endif
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-white mb-2 flex-grow">
                            <span class="text-sici-red">Evento:</span><br>{{ $evento->title }}
                        </h3>
                        <p class="text-sici-muted text-sm mb-4 font-mono">{{ $evento->eventDetails->start_date->format('d M Y') }}</p>
                        <a href="{{ route('events.show', $evento) }}" class="text-sici-red font-bold text-sm tracking-wide hover:underline flex items-center mt-auto">
                            Leer más <span class="ml-1">&gt;</span>
                        </a>
                    </div>
                </div>
                @endforeach

            </div>
            @else
            <div class="text-center text-sici-muted">
                <p>No hay publicaciones ni eventos recientes para mostrar.</p>
            </div>
            @endif
            
        </div>
    </section>

</x-layout>