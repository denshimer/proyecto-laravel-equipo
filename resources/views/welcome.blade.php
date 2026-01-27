<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SICI - ISI | Home</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700&family=Inter:wght@400;600&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-sici-dark text-sici-light font-sans antialiased">

        <nav class="border-b border-gray-800 bg-sici-dark/95 fixed w-full z-50 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="SICI-ISI Logo">
                    </div>

                    <div class="hidden md:flex space-x-8">
                        <a href="#" class="text-sici-red font-semibold font-display text-lg">Inicio</a>
                        <a href="#" class="text-sici-light hover:text-sici-red transition font-display text-lg">Sobre SICI-ISI</a>
                        <a href="#" class="text-sici-light hover:text-sici-red transition font-display text-lg">Publicaciones</a>
                        <a href="#" class="text-sici-light hover:text-sici-red transition font-display text-lg">Eventos</a>
                    </div>

                    <div>
                        <a href="{{ route('login') }}" class="bg-sici-red hover:bg-sici-redDark text-white px-6 py-2 rounded font-semibold transition">
                            Ingresar
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <header class="relative bg-cover bg-center h-[600px] flex items-center" style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
            <div class="absolute inset-0 bg-sici-dark/70"></div>
            
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
                            <img src="{{ asset('images/card.jpeg') }}" alt="Evento" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
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
                
                <div class="flex justify-center mt-10 space-x-2">
                     <span class="w-8 h-1 bg-sici-red rounded-full"></span>
                     <span class="w-2 h-1 bg-gray-600 rounded-full"></span>
                     <span class="w-2 h-1 bg-gray-600 rounded-full"></span>
                </div>
            </div>
        </section>

        <footer class="bg-sici-card border-t border-sici-red/30 pt-16 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                    
                    <div>
                        <h4 class="text-xl font-bold text-white mb-6">Contacto</h4>
                        <ul class="space-y-4 text-sici-light">
                            <li class="flex items-center">
                                <span class="mr-3">📞</span> 7xxxxxxxxx
                            </li>
                            <li class="flex items-center">
                                <span class="mr-3">✉️</span> univalle@univalle.edu
                            </li>
                        </ul>
                    </div>

                    <div class="text-center md:text-left">
                        <h4 class="text-xl font-bold text-white mb-6">Social</h4>
                        <div class="flex justify-center md:justify-start space-x-6">
                            <a href="#" class="text-gray-400 hover:text-white"><span class="text-2xl">🎵</span></a> <a href="#" class="text-blue-600 hover:text-blue-500"><span class="text-2xl">fb</span></a> <a href="#" class="text-red-600 hover:text-red-500"><span class="text-2xl">▶️</span></a> </div>
                    </div>

                    <div class="text-right">
                        <h4 class="text-sici-red font-bold text-xl mb-6">Inicio</h4>
                        <ul class="space-y-3 text-sici-light">
                            <li><a href="#" class="hover:text-sici-red transition">Sobre SICI-ISI</a></li>
                            <li><a href="#" class="hover:text-sici-red transition">Publicaciones</a></li>
                            <li><a href="#" class="hover:text-sici-red transition">Eventos</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-800 pt-8 text-center">
                     <img class="h-16 w-auto mx-auto mb-4" src="{{ asset('images/logo.png') }}" alt="SICI-ISI Logo Footer">
                </div>
            </div>
        </footer>
    </body>
</html>