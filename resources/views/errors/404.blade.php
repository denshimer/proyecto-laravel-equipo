<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-8 text-center">
            <div class="text-6xl mb-4">🔍</div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Página No Encontrada</h1>
            <p class="text-gray-600 mb-6">
                La página que buscas no existe o ha sido movida.
            </p>
            
            <div class="space-y-3">
                @auth
                <a href="{{ route('dashboard') }}" class="block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg transition">
                    Ir al Dashboard
                </a>
                @endauth
                
                <a href="{{ route('home') }}" class="block bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-lg transition">
                    Volver al Inicio
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
