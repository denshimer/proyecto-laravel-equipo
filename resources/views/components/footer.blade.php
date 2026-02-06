<footer class="bg-sici-card border-t border-sici-red/30 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            
            {{-- Logo y Descripción --}}
            <div class="md:col-span-2">
                <img style="height: 80px; width: auto;" class="mb-4" src="{{ asset('images/logo.png') }}" alt="SICI-ISI Logo">
                <p class="text-gray-400 text-sm leading-relaxed max-w-md">
                    Sociedad de Investigación, Ciencia e Innovación de la carrera de Ingeniería de Sistemas Informáticos.
                </p>
            </div>

            {{-- Enlaces Rápidos --}}
            <div>
                <h4 class="text-white font-bold text-lg mb-4 font-display">Enlaces</h4>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('welcome') }}" class="text-gray-400 hover:text-sici-red transition flex items-center group">
                            <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-gray-400 hover:text-sici-red transition flex items-center group">
                            <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Nosotros
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('publications') }}" class="text-gray-400 hover:text-sici-red transition flex items-center group">
                            <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Publicaciones
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('events') }}" class="text-gray-400 hover:text-sici-red transition flex items-center group">
                            <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Eventos
                        </a>
                    </li>
                    @auth
                    <li>
                        <a href="{{ route('profile.edit') }}" class="text-gray-400 hover:text-sici-red transition flex items-center group">
                            <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Mi Perfil
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>

            {{-- Contacto y Redes --}}
            <div>
                <h4 class="text-white font-bold text-lg mb-4 font-display">Contacto</h4>
                <ul class="space-y-3 mb-6">
                    <li class="flex items-start text-gray-400 text-sm">
                        <svg class="w-5 h-5 mr-2 text-sici-red flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>7xxxxxxxxx</span>
                    </li>
                    <li class="flex items-start text-gray-400 text-sm">
                        <svg class="w-5 h-5 mr-2 text-sici-red flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>univalle@univalle.edu</span>
                    </li>
                </ul>

                <h5 class="text-white font-semibold text-sm mb-3">Síguenos</h5>
                <div class="flex space-x-3">
                    {{-- TikTok --}}
                    <a href="#" class="bg-gray-800 hover:bg-sici-red p-2.5 rounded-lg transition group" title="TikTok">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/>
                        </svg>
                    </a>
                    
                    {{-- Facebook --}}
                    <a href="#" class="bg-gray-800 hover:bg-blue-600 p-2.5 rounded-lg transition group" title="Facebook">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    
                    {{-- YouTube --}}
                    <a href="#" class="bg-gray-800 hover:bg-red-600 p-2.5 rounded-lg transition group" title="YouTube">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="border-t border-gray-800 pt-6 mt-6">
            <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                <p class="mb-2 md:mb-0">© {{ date('Y') }} SICI-ISI. Todos los derechos reservados.</p>
                <p class="text-xs">Universidad del Valle - Ingeniería de Sistemas Informáticos</p>
            </div>
        </div>
    </div>
</footer>