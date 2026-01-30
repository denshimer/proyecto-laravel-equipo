<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mi Espacio 🎒') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Información del Estudiante -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-lg">Bienvenido, <strong>{{ Auth::user()->name }}</strong></p>
                <p class="text-sm text-gray-500">
                    RU: {{ Auth::user()->student?->university_code ?? 'No registrado (Externo)' }}
                </p>
                <div class="mt-4">
                    <a href="{{ route('student.events.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm transition">
                        🔍 Explorar Eventos Disponibles
                    </a>
                </div>
            </div>

            <!-- Mis Inscripciones -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Mis Inscripciones</h3>
                    <a href="{{ route('home') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm transition">
                        🔍 Explorar Eventos
                    </a>
                </div>
                
                @if($misInscripciones->isEmpty())
                    <p class="text-gray-400 italic">No estás inscrito en ningún evento aún.</p>
                    <a href="{{ route('home') }}" class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition">
                        Ver Eventos Disponibles
                    </a>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($misInscripciones as $inscripcion)
                        <div class="border rounded-lg p-4 hover:shadow-md transition">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-bold text-lg">{{ $inscripcion->post->title }}</h4>
                                <span class="px-2 py-1 rounded text-xs font-semibold
                                    {{ $inscripcion->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($inscripcion->status) }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">
                                Por: {{ $inscripcion->post->author->name }}
                            </p>
                            <div class="flex items-center justify-between text-sm mb-3">
                                <span class="text-gray-500">
                                    📅 {{ $inscripcion->post->eventDetails?->start_date?->format('d/m/Y H:i') ?? 'Sin fecha' }}
                                </span>
                                <span class="text-gray-500">
                                    📍 {{ $inscripcion->post->eventDetails?->location ?? 'N/A' }}
                                </span>
                            </div>
                            @if($inscripcion->status === 'confirmed')
                            <form action="{{ route('student.registrations.cancel', $inscripcion) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm transition"
                                    onclick="return confirm('¿Estás seguro de cancelar esta inscripción?')">
                                    Cancelar Inscripción
                                </button>
                            </form>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
