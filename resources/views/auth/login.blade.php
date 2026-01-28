<x-guest-layout title="Iniciar Sesión | SICI-ISI">
    
    <div class="bg-sici-card border border-gray-800 rounded-xl shadow-2xl p-8 backdrop-blur-sm">
        
        <h2 class="text-2xl font-display font-bold text-center text-white mb-8 tracking-wide">
            INICIAR SESIÓN
        </h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <input id="email" type="email" name="email" required autofocus placeholder="Correo Electrónico"
                        class="bg-sici-dark border border-gray-700 text-gray-300 text-sm rounded-lg focus:ring-sici-red focus:border-sici-red block w-full pl-10 p-3 placeholder-gray-600 transition shadow-inner">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
            </div>

            <div class="mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <input id="password" type="password" name="password" required placeholder="Contraseña"
                        class="bg-sici-dark border border-gray-700 text-gray-300 text-sm rounded-lg focus:ring-sici-red focus:border-sici-red block w-full pl-10 p-3 placeholder-gray-600 transition shadow-inner">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
            </div>

            <button type="submit" class="w-full text-white bg-sici-red hover:bg-sici-redDark font-bold rounded-lg text-sm px-5 py-3 text-center transition duration-300 shadow-lg transform hover:-translate-y-1">
                Ingresar
            </button>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-700"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-sici-card text-gray-500">O continúa con</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <button type="button" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-sici-dark border border-gray-700 rounded-md hover:bg-gray-800 transition">
                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z"/></svg>
                        Google
                    </button>
                    <button type="button" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-sici-dark border border-gray-700 rounded-md hover:bg-gray-800 transition">
                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M0 0h11.377v11.372H0zM12.623 0H24v11.372H12.623zM0 12.623h11.377V24H0zM12.623 12.623H24V24H12.623z"/></svg>
                        Microsoft
                    </button>
                </div>
            </div>
            
            <div class="mt-8 text-center space-y-4">
                <div>
                    <a href="{{ route('password.request') }}" class="text-sm text-sici-muted hover:text-white transition">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>
                <div>
                    <span class="text-sm text-gray-500">¿No tienes cuenta?</span>
                    <a href="{{ route('register') }}" class="text-sm font-bold text-sici-red hover:text-red-400 transition ml-1">
                        Regístrate
                    </a>
                </div>
            </div>

        </form>
    </div>
</x-guest-layout>