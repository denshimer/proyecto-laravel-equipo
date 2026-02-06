<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inscritos al Evento') }}: {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Información del Evento -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold mb-4">Información del Evento</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Fecha:</span>
                        <span class="font-semibold ml-2">{{ $event->eventDetails?->start_date?->format('d/m/Y H:i') ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Ubicación:</span>
                        <span class="font-semibold ml-2">{{ $event->eventDetails?->location ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Inscritos:</span>
                        <span class="font-semibold ml-2">
                            {{ $event->registrations->count() }}
                            @if($event->eventDetails?->max_attendees)
                            / {{ $event->eventDetails->max_attendees }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Lista de Inscritos -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($event->registrations->isEmpty())
                <div class="p-6 text-center text-gray-500">
                    No hay inscripciones aún para este evento.
                </div>
                @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">RU</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha Inscripción</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($event->registrations as $index => $registration)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $registration->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $registration->user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $registration->user->student?->university_code ?? 'Externo' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $registration->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $registration->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($registration->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <div class="mt-6">
                <a href="{{ route('teacher.events.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded transition">
                    ← Volver a Mis Eventos
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
