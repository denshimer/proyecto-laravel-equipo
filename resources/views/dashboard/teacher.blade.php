<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel Docente 🎓') }} - {{ Auth::user()->teacher->academic_degree ?? '' }} {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Mis Eventos Académicos</h3>
                    <a href="#" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm">Crear Nuevo Evento</a>
                </div>
                
                @if($misEventos->isEmpty())
                    <p class="text-gray-500">Aún no has creado eventos.</p>
                @else
                    <ul>
                        @foreach($misEventos as $evento)
                            <li class="border-b py-2">{{ $evento->title }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>