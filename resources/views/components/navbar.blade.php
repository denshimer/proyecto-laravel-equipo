<nav class="border-b border-gray-800 bg-sici-dark/95 fixed w-full z-50 backdrop-blur-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">

            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}">
                    <img style="height: 130px; width: auto;" class="mx-auto mb-4" src="{{ asset('images/logo.png') }}" alt="SICI-ISI Logo">
                </a>
            </div>

            <div class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" 
                    class="{{ request()->routeIs('home') ? 'text-sici-red font-bold' : 'text-sici-light hover:text-sici-red' }} transition font-display text-lg">
                        Inicio
                </a>

                <a href="{{ route('about') }}" 
                    class="{{ request()->routeIs('about') ? 'text-sici-red font-bold' : 'text-sici-light hover:text-sici-red' }} transition font-display text-lg">
                        Sobre SICI-ISI
                </a>    
                <a href="{{ route('publications') }}" 
                    class="{{ request()->routeIs('publications') ? 'text-sici-red font-bold' : 'text-sici-light hover:text-sici-red' }} transition font-display text-lg">
                        Publicaciones
                    </a>
                <a href="{{ route('events') }}" 
                    class="{{ request()->routeIs('events') ? 'text-sici-red font-bold' : 'text-sici-light hover:text-sici-red' }} transition font-display text-lg">
                        Eventos
                </a>
            </div>

            <div>
                <a href="{{ route('login') }}" class="bg-sici-red hover:bg-sici-redDark text-white px-6 py-2 rounded font-semibold transition">
                    Ingresar
                </a>
            </div>
        </div>
    </div>
</nav>