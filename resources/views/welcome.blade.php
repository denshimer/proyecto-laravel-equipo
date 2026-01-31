<x-layout title="Inicio | SICI-ISI">

        <header class="relative bg-cover bg-center h-[600px] flex items-center">
            <div class="absolute inset-0 bg-sici-dark/70" style="background-image: url('{{ asset('images/hero-bg.png') }}'); opacity: 0.2;"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="max-w-3xl">
                    <h2 class="text-sici-red font-bold text-xl md:text-2xl mb-2 tracking-wider">BIENVENIDO A SICI-ISI</h2>
                    <h1 class="text-4xl md:text-6xl font-display font-bold text-white leading-tight mb-4">
                        Sociedad de Investigación, Ciencia e Innovación.<br>
                        INGENIERÍA DE SISTEMAS INFORMÁTICOS
                    </h1>
                    <p class="text-lg md:text-xl text-gray-300 mb-6">
                        La Sociedad de Ciencia, Investigación e Innovación (SICI) de la carrera de Ingeniería de Sistemas Informáticos es una comunidad de estudiantes y docentes dedicados a explorar y promover el avance tecnológico.
                    </p>
                    <p class="text-lg md:text-xl text-gray-300 mb-6">
                        Un espacio dedicado a la vanguardia tecnológica y el desarrollo académico en la carrera de Ingeniería de Sistemas Informáticos.
                    </p>
                    <a href="{{ route('about') }}" class="bg-sici-red hover:bg-sici-redDark text-white px-8 py-3 rounded font-semibold text-lg transition">
                        Conoce más
                    </a>
                </div>
            </div>
        </header>

        <section class="py-20 bg-sici-dark">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-display font-semibold text-white mb-10 text-center">Publicaciones y Eventos Recientes</h2>

                @if($publications->isNotEmpty() || $events->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    @foreach ($publications as $publication)
                    <div class="bg-sici-card rounded-lg overflow-hidden border border-gray-800 group hover:border-sici-red transition duration-300 flex flex-col">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('images/card.jpeg') }}" alt="Imagen de la publicación" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-white mb-2 flex-grow">
                                <span class="text-sici-red">Publicación:</span><br>{{ $publication->title }}
                            </h3>
                            <p class="text-sici-muted text-sm mb-4 font-mono">{{ $publication->created_at->format('d M Y') }}</p>
                            <a href="{{ route('publications.show', $publication) }}" class="text-sici-red font-bold text-sm tracking-wide hover:underline flex items-center mt-auto">
                                Leer más <span class="ml-1">&gt;</span>
                            </a>
                        </div>
                    </div>
                    @endforeach

                    @foreach ($events as $event)
                    <div class="bg-sici-card rounded-lg overflow-hidden border border-gray-800 group hover:border-sici-red transition duration-300 flex flex-col">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('images/card.jpeg') }}" alt="Imagen del evento" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-white mb-2 flex-grow">
                                <span class="text-sici-red">Evento:</span><br>{{ $event->title }}
                            </h3>
                            <p class="text-sici-muted text-sm mb-4 font-mono">{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
                            <a href="{{ route('events.show', $event) }}" class="text-sici-red font-bold text-sm tracking-wide hover:underline flex items-center mt-auto">
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