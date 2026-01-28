<x-layout title="Inicio | SICI-ISI">

        <header class="relative bg-cover bg-center h-[600px] flex items-center">
            <div class="absolute inset-0 bg-sici-dark/70" style="background-image: url('{{ asset('images/hero-bg.png') }}'); opacity: 0.2;"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="max-w-3xl">
                    <h2 class="text-sici-red font-bold text-xl md:text-2xl mb-2 tracking-wider">BIENVENIDO A SICI-ISI</h2>
                    <h1 class="text-4xl md:text-6xl font-display font-bold text-white leading-tight mb-6">
                        Sociedad de Investigación, Ciencia e Innovación.<br>
                        INGENIERÍA DE SISTEMAS INFORMÁTICOS
                    </h1>
                    <button class="bg-sici-red hover:bg-sici-redDark text-white px-8 py-3 rounded font-semibold text-lg transition">
                        Conoce más
                    </button>
                </div>
            </div>
        </header>

        <section class="py-20 bg-sici-dark">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-display font-semibold text-white mb-10">Publicaciones y Eventos</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <div class="bg-sici-card rounded-lg overflow-hidden border border-gray-800 group hover:border-sici-red transition duration-300">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('images/card.jpeg') }}" alt="Evento" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-2">Publicación: <br>Sobre los proyectos de grado</h3>
                            <p class="text-sici-muted text-sm mb-4 font-mono">10 febrero 2026</p>
                            <a href="#" class="text-sici-red font-bold text-sm tracking-wide hover:underline flex items-center">
                                Leer más <span class="ml-1">&gt;</span>
                            </a>
                        </div>
                    </div>

                    <div class="bg-sici-card rounded-lg overflow-hidden border border-gray-800 group hover:border-sici-red transition duration-300">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('images/hero-bg.png') }}" alt="Evento" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-2">Evento: <br>Bootcamp Frontend</h3>
                            <p class="text-sici-muted text-sm mb-4 font-mono">16 febrero 2026</p>
                            <a href="#" class="text-sici-red font-bold text-sm tracking-wide hover:underline flex items-center">
                                Leer más <span class="ml-1">&gt;</span>
                            </a>
                        </div>
                    </div>

                    <div class="bg-sici-card rounded-lg overflow-hidden border border-gray-800 group hover:border-sici-red transition duration-300">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('images/card.jpeg') }}" alt="Evento" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-2">Publicación: <br>Modernizar la Universidad</h3>
                            <p class="text-sici-muted text-sm mb-4 font-mono">17 febrero 2026</p>
                            <a href="#" class="text-sici-red font-bold text-sm tracking-wide hover:underline flex items-center">
                                Leer más <span class="ml-1">&gt;</span>
                            </a>
                        </div>
                    </div>

                </div>
                
                
            </div>
        </section>

</x-layout>