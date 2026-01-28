<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Directiva 🏛️') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Resumen de la Sociedad</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-100 p-4 rounded">
                        <span class="block text-2xl font-bold">{{ $totalUsuarios }}</span>
                        <span class="text-sm text-blue-800">Usuarios Registrados</span>
                    </div>
                    <div class="bg-green-100 p-4 rounded">
                        <span class="block text-2xl font-bold">{{ $totalEventos }}</span>
                        <span class="text-sm text-green-800">Eventos Totales</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>