<x-guest-layout title="Registrarse | SICI-ISI">
    
    <div class="bg-sici-card border border-gray-800 rounded-xl shadow-2xl p-8 backdrop-blur-sm">
        
        <h2 class="text-2xl font-display font-bold text-center text-white mb-8 tracking-wide">
            REGISTRARSE
        </h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-5">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus placeholder="Nombre Completo"
                        class="bg-sici-dark border border-gray-700 text-gray-300 text-sm rounded-lg focus:ring-sici-red focus:border-sici-red block w-full pl-10 p-3 placeholder-gray-600 transition shadow-inner">
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-xs" />
            </div>

            <div class="mb-5">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <input id="email" type="email" name="email" :value="old('email')" required placeholder="Correo Electrónico"
                        class="bg-sici-dark border border-gray-700 text-gray-300 text-sm rounded-lg focus:ring-sici-red focus:border-sici-red block w-full pl-10 p-3 placeholder-gray-600 transition shadow-inner">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
            </div>

            <div class="mb-5">
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

            <div class="mb-8">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Confirmar Contraseña"
                        class="bg-sici-dark border border-gray-700 text-gray-300 text-sm rounded-lg focus:ring-sici-red focus:border-sici-red block w-full pl-10 p-3 placeholder-gray-600 transition shadow-inner">
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-xs" />
            </div>

            <button type="submit" class="w-full text-white bg-sici-red hover:bg-sici-redDark font-bold rounded-lg text-sm px-5 py-3 text-center transition duration-300 shadow-lg transform hover:-translate-y-1">
                Registrarse
            </button>

            <div class="mt-6 text-center">
                <span class="text-sm text-gray-500">¿Ya tienes cuenta?</span>
                <a href="{{ route('login') }}" class="text-sm font-bold text-sici-red hover:text-red-400 transition ml-1">
                    Inicia Sesión
                </a>
            </div>

        </form>
    </div>
</x-guest-layout>