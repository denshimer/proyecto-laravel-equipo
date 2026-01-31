<footer class="bg-sici-card border-t border-sici-red/30 pt-16 pb-8 mt-auto">
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
                    <a href="#" class="text-gray-400 hover:text-white"><span class="text-2xl">🎵</span></a>
                    <a href="#" class="text-blue-600 hover:text-blue-500"><span class="text-2xl">fb</span></a>
                    <a href="#" class="text-red-600 hover:text-red-500"><span class="text-2xl">▶️</span></a>
                </div>
            </div>

            <div class="text-right">
                <ul class="space-y-3 text-sici-light">
                    <li><a href="{{ url('/') }}" class="text-sici-red font-semibold font-display text-lg">Inicio</a></li>
                    <li><a href="#" class="hover:text-sici-red transition">Sobre SICI-ISI</a></li>
                    <li><a href="#" class="hover:text-sici-red transition">Publicaciones</a></li>
                    <li><a href="#" class="hover:text-sici-red transition">Eventos</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 text-center">
             <img style="height: 190px; width: auto;" class="mx-auto mb-4" src="{{ asset('images/logo.png') }}" alt="SICI-ISI Logo Footer">
        </div>
    </div>
</footer>