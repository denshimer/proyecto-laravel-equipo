<x-dashboard-layout title="Eventos Disponibles | SICI-ISI" header="Eventos Disponibles">
    
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Volver al Dashboard
        </a>
    </div>

    <x-alert type="success" />
    <x-alert type="error" />

    @if($events->isEmpty())
    <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl p-12 text-center">
        <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <p class="text-gray-400">No hay eventos disponibles en este momento.</p>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($events as $event)
        <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl p-6 hover:border-gray-700 transition">
            <h3 class="font-bold text-lg mb-2 text-white">{{ $event->title }}</h3>
            
            <p class="text-sm text-gray-400 mb-4">
                {{ Str::limit($event->excerpt ?? $event->body, 120) }}
            </p>
            
            <div class="space-y-2 text-sm text-gray-500 mb-4">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                    {{ $event->eventDetails?->start_date?->format('d/m/Y H:i') ?? 'Por definir' }}
                </div>
                
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    {{ $event->eventDetails?->location ?? 'Por definir' }}
                </div>
                
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                    <span class="text-gray-400">Por:</span> {{ $event->author->name }}
                </div>
                
                @if($event->eventDetails?->max_attendees)
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                    </svg>
                    {{ $event->registrations_count }} / {{ $event->eventDetails->max_attendees }} inscritos
                </div>
                @else
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                    </svg>
                    {{ $event->registrations_count }} inscritos
                </div>
                @endif
            </div>
            
            <form action="{{ route('student.events.register', $event) }}" method="POST">
                @csrf
                <button type="submit" 
                    class="w-full px-4 py-2 rounded-lg transition font-semibold
                    @if($event->eventDetails?->max_attendees && $event->registrations_count >= $event->eventDetails->max_attendees)
                        bg-gray-600 text-gray-400 cursor-not-allowed
                    @else
                        bg-sici-red hover:bg-sici-redDark text-white shadow-lg shadow-red-900/20
                    @endif"
                    @if($event->eventDetails?->max_attendees && $event->registrations_count >= $event->eventDetails->max_attendees) disabled @endif>
                    @if($event->eventDetails?->max_attendees && $event->registrations_count >= $event->eventDetails->max_attendees)
                        Cupo Completo
                    @else
                        Inscribirse
                    @endif
                </button>
            </form>
        </div>
        @endforeach
    </div>
    
    <div class="mt-6">
        {{ $events->links() }}
    </div>
    @endif

</x-dashboard-layout>
