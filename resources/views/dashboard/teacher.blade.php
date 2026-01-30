<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel Docente 🎓') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Mis Eventos -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Mis Eventos Académicos</h3>
                    <a href="{{ route('teacher.events.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm transition">
                        ➕ Crear Nuevo Evento
                    </a>
                </div>
                
                @if($misEventos->isEmpty())
                    <p class="text-gray-500">Aún no has creado eventos.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($misEventos as $evento)
                        <div class="border rounded-lg p-4 hover:shadow-md transition">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-bold text-lg">{{ $evento->title }}</h4>
                                <span class="px-2 py-1 rounded text-xs font-semibold
                                    {{ $evento->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $evento->is_published ? 'Publicado' : 'Borrador' }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">
                                {{ Str::limit($evento->excerpt, 100) }}
                            </p>
                            <div class="flex items-center justify-between text-sm mb-3">
                                <span class="text-gray-500">
                                    📅 {{ $evento->eventDetails?->start_date?->format('d/m/Y') ?? 'Sin fecha' }}
                                </span>
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">
                                    {{ $evento->registrations_count }} inscritos
                                </span>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('teacher.events.edit', $evento) }}" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded text-xs text-center transition">
                                    Editar
                                </a>
                                <a href="{{ route('teacher.events.registrations', $evento) }}" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-xs text-center transition">
                                    Ver Inscritos
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Inscripciones Recientes -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Inscripciones Recientes a Mis Eventos</h3>
                
                @if($inscripcionesRecientes->isEmpty())
                    <p class="text-gray-500">No hay inscripciones aún.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estudiante</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Evento</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha Inscripción</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($inscripcionesRecientes as $inscripcion)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $inscripcion->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $inscripcion->post->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $inscripcion->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
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
        </div>
    </div>
</x-app-layout>