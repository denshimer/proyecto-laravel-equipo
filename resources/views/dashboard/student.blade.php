<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mi Espacio 🎒') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p>Bienvenido, <strong>{{ Auth::user()->name }}</strong></p>
                <p class="text-sm text-gray-500">
                    RU: {{ Auth::user()->student->university_code ?? 'No registrado (Externo)' }}
                </p>

                <h3 class="mt-6 font-bold">Mis Inscripciones</h3>
                <p class="text-gray-400 italic">Próximamente verás aquí tus eventos...</p>
            </div>
        </div>
    </div>
</x-app-layout>