<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mis Eventos') }}
            </h2>
            <a href="{{ route('teacher.events.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition">
                ➕ Crear Evento
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert type="success" />
            <x-alert type="error" />

            @if($events->isEmpty())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <p class="text-gray-500 mb-4">Aún no has creado ningún evento.</p>
                <a href="{{ route('teacher.events.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition">
                    Crear Mi Primer Evento
                </a>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="font-bold text-lg">{{ $event->title }}</h3>
                        <span class="px-2 py-1 rounded text-xs font-semibold
                            {{ $event->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $event->is_published ? 'Publicado' : 'Borrador' }}
                        </span>
                    </div>
                    
                    <p class="text-sm text-gray-600 mb-4">
                        {{ Str::limit($event->excerpt, 120) }}
                    </p>
                    
                    <div class="space-y-2 text-sm text-gray-500 mb-4">
                        <div>📅 {{ $event->eventDetails?->start_date?->format('d/m/Y H:i') ?? 'Sin fecha' }}</div>
                        <div>📍 {{ $event->eventDetails?->location ?? 'Sin ubicación' }}</div>
                        <div>👥 {{ $event->registrations_count }} inscritos</div>
                    </div>
                    
                    <div class="flex gap-2">
                        <a href="{{ route('teacher.events.edit', $event) }}" 
                            class="flex-1 bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded text-sm text-center transition">
                            Editar
                        </a>
                        <a href="{{ route('teacher.events.registrations', $event) }}" 
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded text-sm text-center transition">
                            Ver Inscritos
                        </a>
                    </div>
                    
                    <div class="flex gap-2 mt-2">
                        <form action="{{ route('teacher.events.toggle-publish', $event) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm transition">
                                {{ $event->is_published ? 'Despublicar' : 'Publicar' }}
                            </button>
                        </form>
                        <form action="{{ route('teacher.events.destroy', $event) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('¿Estás seguro de eliminar este evento?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-sm transition">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                {{ $events->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
