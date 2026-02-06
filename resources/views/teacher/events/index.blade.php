<x-dashboard-layout title="Mis Eventos | SICI-ISI" header="Mis Eventos">
    
    <!-- Botón Crear Evento (header) -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Volver al Dashboard
        </a>
        <a href="{{ route('teacher.events.create') }}" class="bg-sici-red hover:bg-sici-redDark text-white px-6 py-3 rounded-lg transition font-semibold shadow-lg shadow-red-900/20">
            ➕ Crear Evento
        </a>
    </div>

    <x-alert type="success" />
    <x-alert type="error" />

    @if($events->isEmpty())
    <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl p-12 text-center">
        <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <p class="text-gray-400 mb-4">Aún no has creado ningún evento.</p>
        <a href="{{ route('teacher.events.create') }}" class="inline-flex items-center bg-sici-red hover:bg-sici-redDark text-white px-6 py-3 rounded-lg transition font-semibold shadow-lg shadow-red-900/20">
            Crear Mi Primer Evento
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($events as $event)
        <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl p-6">
            <div class="flex justify-between items-start mb-3">
                <h3 class="font-bold text-lg text-white">{{ $event->title }}</h3>
                <span class="px-3 py-1 rounded-full text-xs font-semibold
                    {{ $event->is_published ? 'bg-green-500/10 text-green-500' : 'bg-yellow-500/10 text-yellow-500' }}">
                    {{ $event->is_published ? 'Publicado' : 'Borrador' }}
                </span>
            </div>
            
            <p class="text-sm text-gray-400 mb-4">
                {{ Str::limit($event->excerpt, 120) }}
            </p>
            
            <div class="space-y-2 text-sm text-gray-500 mb-4">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ $event->eventDetails?->start_date?->format('d/m/Y H:i') ?? 'Sin fecha' }}
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    {{ $event->eventDetails?->location ?? 'Sin ubicación' }}
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    {{ $event->registrations_count }} inscritos
                </div>
            </div>
            
            <div class="flex gap-2">
                <a href="{{ route('teacher.events.edit', $event) }}" 
                    class="flex-1 bg-gray-700 hover:bg-gray-600 text-white px-3 py-2 rounded-lg text-sm text-center transition font-semibold">
                    Editar
                </a>
                <a href="{{ route('teacher.events.registrations', $event) }}" 
                    class="flex-1 bg-sici-red hover:bg-sici-redDark text-white px-3 py-2 rounded-lg text-sm text-center transition font-semibold shadow-lg shadow-red-900/20">
                    Ver Inscritos
                </a>
            </div>
            
            <div class="flex gap-2 mt-2">
                <form action="{{ route('teacher.events.toggle-publish', $event) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm transition font-semibold">
                        {{ $event->is_published ? 'Despublicar' : 'Publicar' }}
                    </button>
                </form>
                <form action="{{ route('teacher.events.destroy', $event) }}" method="POST" class="flex-1"
                    onsubmit="return confirm('¿Estás seguro de eliminar este evento?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm transition font-semibold shadow-lg shadow-red-900/20">
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

</x-dashboard-layout>
