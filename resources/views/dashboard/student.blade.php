<x-dashboard-layout title="Mi Espacio | SICI-ISI" header="Mi Espacio 🎒">
    
    <!-- Botón Volver al Inicio -->
    <div class="mb-6">
        <a href="{{ route('welcome') }}" class="inline-flex items-center text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Ir al Inicio
        </a>
    </div>

    <!-- Información del Estudiante -->
    <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl p-6 mb-6">
        <p class="text-lg text-white">Bienvenido, <strong>{{ Auth::user()->name }}</strong></p>
        <p class="text-sm text-gray-400">
            RU: {{ Auth::user()->student?->university_code ?? 'No registrado (Externo)' }}
        </p>
        <div class="mt-4">
            <a href="{{ route('student.events.index') }}" class="inline-flex items-center bg-sici-red hover:bg-sici-redDark text-white px-6 py-3 rounded-lg text-sm transition font-semibold shadow-lg shadow-red-900/20">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Explorar Eventos Disponibles
            </a>
        </div>
    </div>

    <!-- Mis Inscripciones -->
    <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-white">Mis Inscripciones</h3>
            <a href="{{ route('home') }}" class="bg-sici-red hover:bg-sici-redDark text-white px-4 py-2 rounded-lg text-sm transition font-semibold shadow-lg shadow-red-900/20">
                🔍 Explorar Eventos
            </a>
        </div>
        
        @if($misInscripciones->isEmpty())
            <div class="text-center py-8">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p class="text-gray-400 italic mb-4">No estás inscrito en ningún evento aún.</p>
                <a href="{{ route('home') }}" class="inline-flex items-center bg-sici-red hover:bg-sici-redDark text-white px-6 py-3 rounded-lg transition font-semibold shadow-lg shadow-red-900/20">
                    Ver Eventos Disponibles
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($misInscripciones as $inscripcion)
                <div class="border border-gray-700 rounded-lg p-4 bg-sici-dark/30 hover:bg-gray-800/50 transition">
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="font-bold text-lg text-white">{{ $inscripcion->post->title }}</h4>
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            {{ $inscripcion->status === 'confirmed' ? 'bg-green-500/10 text-green-500' : 'bg-gray-500/10 text-gray-500' }}">
                            {{ ucfirst($inscripcion->status) }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-400 mb-2">
                        Por: {{ $inscripcion->post->author->name }}
                    </p>
                    <div class="flex items-center justify-between text-sm mb-3">
                        <span class="text-gray-500 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $inscripcion->post->eventDetails?->start_date?->format('d/m/Y H:i') ?? 'Sin fecha' }}
                        </span>
                        <span class="text-gray-500 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $inscripcion->post->eventDetails?->location ?? 'N/A' }}
                        </span>
                    </div>
                    @if($inscripcion->status === 'confirmed')
                    <form action="{{ route('student.registrations.cancel', $inscripcion) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm transition font-semibold shadow-lg shadow-red-900/20"
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

</x-dashboard-layout>
