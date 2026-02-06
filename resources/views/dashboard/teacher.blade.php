<x-dashboard-layout title="Panel Docente | SICI-ISI" header="Panel Docente 🎓">
    
    <!-- Botón Volver al Inicio -->
    <div class="mb-6">
        <a href="{{ route('welcome') }}" class="inline-flex items-center text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Ir al Inicio
        </a>
    </div>

    <!-- Mis Eventos -->
    <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-white">Mis Eventos Académicos</h3>
            <a href="{{ route('teacher.events.create') }}" class="bg-sici-red hover:bg-sici-redDark text-white px-4 py-2 rounded-lg text-sm transition font-semibold shadow-lg shadow-red-900/20">
                ➕ Crear Nuevo Evento
            </a>
        </div>
        
        @if($misEventos->isEmpty())
            <p class="text-gray-500">Aún no has creado eventos.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($misEventos as $evento)
                <div class="border border-gray-700 rounded-lg p-4 bg-sici-dark/30 hover:bg-gray-800/50 transition">
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="font-bold text-lg text-white">{{ $evento->title }}</h4>
                        <span class="px-2 py-1 rounded text-xs font-semibold
                            {{ $evento->is_published ? 'bg-green-500/10 text-green-500' : 'bg-yellow-500/10 text-yellow-500' }}">
                            {{ $evento->is_published ? 'Publicado' : 'Borrador' }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-400 mb-3">
                        {{ Str::limit($evento->excerpt, 100) }}
                    </p>
                    <div class="flex items-center justify-between text-sm mb-3">
                        <span class="text-gray-500">
                            📅 {{ $evento->eventDetails?->start_date?->format('d/m/Y') ?? 'Sin fecha' }}
                        </span>
                        <span class="bg-blue-500/10 text-blue-500 px-2 py-1 rounded-full font-semibold">
                            {{ $evento->registrations_count }} inscritos
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('teacher.events.edit', $evento) }}" class="flex-1 bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded-lg text-xs text-center transition font-semibold">
                            Editar
                        </a>
                        <a href="{{ route('teacher.events.registrations', $evento) }}" class="flex-1 bg-sici-red hover:bg-sici-redDark text-white px-3 py-1 rounded-lg text-xs text-center transition font-semibold shadow-lg shadow-red-900/20">
                            Ver Inscritos
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Inscripciones Recientes -->
    <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl p-6">
        <h3 class="text-lg font-bold mb-4 text-white">Inscripciones Recientes a Mis Eventos</h3>
        
        @if($inscripcionesRecientes->isEmpty())
            <p class="text-gray-500">No hay inscripciones aún.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-sici-dark/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estudiante</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Evento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Inscripción</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @foreach($inscripcionesRecientes as $inscripcion)
                        <tr class="hover:bg-gray-800/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-white">{{ $inscripcion->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ $inscripcion->post->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-400">{{ $inscripcion->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-500/10 text-green-500">
                                    {{ ucfirst($inscripcion->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</x-dashboard-layout>