<x-guest-layout title="Iniciar Sesión | SICI-ISI">
    
    <div class="bg-sici-card border border-gray-800 rounded-xl shadow-2xl p-8 backdrop-blur-sm">
        
        <!-- Botón Atrás -->
        <div class="mb-4">
            <a href="{{ url()->previous() }}" class="inline-flex items-center text-gray-400 hover:text-white transition duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Atrás
            </a>
        </div>
        
        <h2 class="text-2xl font-display font-bold text-center text-white mb-8 tracking-wide">
            INICIAR SESIÓN
        </h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Correo Electrónico"
                        class="bg-sici-dark border border-gray-700 text-gray-300 text-sm rounded-lg focus:ring-sici-red focus:border-sici-red block w-full pl-10 p-3 placeholder-gray-600 transition shadow-inner">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
            </div>

            <!-- Password -->
            <div class="mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Contraseña"
                        class="bg-sici-dark border border-gray-700 text-gray-300 text-sm rounded-lg focus:ring-sici-red focus:border-sici-red block w-full pl-10 p-3 placeholder-gray-600 transition shadow-inner">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-6">
                <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-sici-red bg-sici-dark border-gray-700 rounded focus:ring-sici-red focus:ring-2">
                <label for="remember_me" class="ml-2 text-sm text-gray-400">Recuérdame</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full text-white bg-sici-red hover:bg-sici-redDark font-bold rounded-lg text-sm px-5 py-3 text-center transition duration-300 shadow-lg transform hover:-translate-y-1">
                Ingresar
            </button>

            <!-- Links -->
            <div class="mt-6 space-y-3 text-center">
                @if (Route::has('password.request'))
                    <div>
                        <a href="{{ route('password.request') }}" class="text-sm text-sici-muted hover:text-white transition">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                @endif
                
                @if (Route::has('register'))
                    <div>
                        <a href="{{ route('register') }}" class="text-sm text-sici-red hover:text-sici-redDark font-semibold transition">
                            ¿No tienes cuenta? Regístrate
                        </a>
                    </div>
                @endif
            </div>

        </form>
    </div>
</x-guest-layout>
