<nav class="border-b border-gray-800 bg-sici-dark/95 fixed w-full z-50 backdrop-blur-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">

            {{-- Logo --}}
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}">
                    <img style="height: 60px; width: auto;" class="block" src="{{ asset('images/logo.png') }}" alt="SICI-ISI Logo">
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden md:flex space-x-8">
                <a href="{{ route('welcome') }}" 
                    class="{{ request()->routeIs('welcome') || request()->routeIs('home') ? 'text-sici-red font-bold' : 'text-sici-light hover:text-sici-red' }} transition font-display text-lg">
                        Inicio
                </a>

                <a href="{{ route('about') }}" 
                    class="{{ request()->routeIs('about') ? 'text-sici-red font-bold' : 'text-sici-light hover:text-sici-red' }} transition font-display text-lg">
                        Nosotros
                </a>

                <a href="{{ route('publications') }}" 
                    class="{{ request()->routeIs('publications*') ? 'text-sici-red font-bold' : 'text-sici-light hover:text-sici-red' }} transition font-display text-lg">
                        Publicaciones
                </a>

                <a href="{{ route('events') }}" 
                    class="{{ request()->routeIs('events*') ? 'text-sici-red font-bold' : 'text-sici-light hover:text-sici-red' }} transition font-display text-lg">
                        Eventos
                </a>

                @auth
                @role('docente')
                <a href="{{ route('teacher.events.index') }}" 
                    class="{{ request()->routeIs('teacher.events.*') ? 'text-sici-red font-bold' : 'text-sici-light hover:text-sici-red' }} transition font-display text-lg">
                        Mis Eventos
                </a>
                @endrole
                @endauth
            </div>

            {{-- Desktop Auth Buttons --}}
            <div class="hidden md:flex items-center gap-4">
                @auth
                <a href="{{ route('dashboard') }}" class="text-sici-light hover:text-sici-red transition font-display font-semibold">
                    Mi Panel
                </a>
                <a href="{{ route('profile.edit') }}" class="text-sici-light hover:text-sici-red transition font-display">
                    {{ auth()->user()->name }}
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-sici-red hover:bg-sici-redDark text-white px-6 py-2 rounded font-semibold transition">
                        Cerrar Sesión
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="bg-sici-red hover:bg-sici-redDark text-white px-6 py-2 rounded font-semibold transition">
                    Ingresar
                </a>
                @endauth
            </div>

            {{-- Mobile Hamburger Button --}}
            <button id="mobile-menu-button" class="md:hidden text-sici-light hover:text-sici-red transition p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>
</nav>

{{-- Mobile Menu Overlay (Outside nav for proper z-index) --}}
<div id="mobile-menu-overlay" class="fixed inset-0 bg-black/60 hidden z-[9998]"></div>

{{-- Mobile Menu Sidebar (Outside nav for proper z-index) --}}
<div id="mobile-menu" class="fixed inset-y-0 right-0 w-72 bg-sici-card border-l border-gray-800 shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out z-[9999]">
    <div class="flex flex-col h-full">
        {{-- Close Button --}}
        <div class="flex justify-between items-center p-4 border-b border-gray-800">
            <span class="text-white font-bold text-lg">Menú</span>
            <button id="mobile-menu-close" class="text-sici-light hover:text-sici-red transition p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        {{-- Mobile Navigation Links --}}
        <nav class="flex-1 overflow-y-auto p-4 space-y-2">
            <a href="{{ route('welcome') }}" 
                class="{{ request()->routeIs('welcome') || request()->routeIs('home') ? 'bg-sici-red text-white' : 'text-sici-light hover:bg-gray-800' }} block px-4 py-3 rounded transition font-display">
                Inicio
            </a>

            <a href="{{ route('about') }}" 
                class="{{ request()->routeIs('about') ? 'bg-sici-red text-white' : 'text-sici-light hover:bg-gray-800' }} block px-4 py-3 rounded transition font-display">
                Nosotros
            </a>

            <a href="{{ route('publications') }}" 
                class="{{ request()->routeIs('publications*') ? 'bg-sici-red text-white' : 'text-sici-light hover:bg-gray-800' }} block px-4 py-3 rounded transition font-display">
                Publicaciones
            </a>

            <a href="{{ route('events') }}" 
                class="{{ request()->routeIs('events*') ? 'bg-sici-red text-white' : 'text-sici-light hover:bg-gray-800' }} block px-4 py-3 rounded transition font-display">
                Eventos
            </a>

            @auth
            <div class="border-t border-gray-800 my-2 pt-2">
                <p class="text-sici-muted text-xs uppercase tracking-wide px-4 mb-2">Mi Cuenta</p>
                
                <a href="{{ route('dashboard') }}" 
                    class="{{ request()->routeIs('dashboard') ? 'bg-sici-red text-white' : 'text-sici-light hover:bg-gray-800' }} block px-4 py-3 rounded transition">
                    🏠 Mi Panel
                </a>

                <a href="{{ route('profile.edit') }}" 
                    class="text-sici-light hover:bg-gray-800 block px-4 py-3 rounded transition">
                    👤 {{ auth()->user()->name }}
                </a>

                @role('docente')
                <a href="{{ route('teacher.events.index') }}" 
                    class="{{ request()->routeIs('teacher.events.*') ? 'bg-sici-red text-white' : 'text-sici-light hover:bg-gray-800' }} block px-4 py-3 rounded transition">
                    📅 Mis Eventos
                </a>
                @endrole
            </div>
            @endauth
        </nav>

        {{-- Mobile Auth Button --}}
        <div class="p-4 border-t border-gray-800">
            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-sici-red hover:bg-sici-redDark text-white px-4 py-3 rounded font-semibold transition">
                    Cerrar Sesión
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="block w-full bg-sici-red hover:bg-sici-redDark text-white px-4 py-3 rounded font-semibold transition text-center">
                Ingresar
            </a>
            @endauth
        </div>
    </div>
</div>

<script>
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

    function openMobileMenu() {
        mobileMenu.classList.remove('translate-x-full');
        mobileMenuOverlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
        mobileMenu.classList.add('translate-x-full');
        mobileMenuOverlay.classList.add('hidden');
        document.body.style.overflow = '';
    }

    mobileMenuButton?.addEventListener('click', openMobileMenu);
    mobileMenuClose?.addEventListener('click', closeMobileMenu);
    mobileMenuOverlay?.addEventListener('click', closeMobileMenu);

    // Close on navigation
    mobileMenu?.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            setTimeout(closeMobileMenu, 100);
        });
    });

    // Close on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !mobileMenuOverlay.classList.contains('hidden')) {
            closeMobileMenu();
        }
    });
</script>
