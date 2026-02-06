@props(['event'])

<div class="border rounded-lg p-4 hover:shadow-md transition bg-white">
    <div class="flex justify-between items-start mb-2">
        <h4 class="font-bold text-lg">{{ $event->title }}</h4>
        @if($event->is_published)
        <span class="px-2 py-1 rounded text-xs font-semibold bg-green-100 text-green-800">
            Publicado
        </span>
        @else
        <span class="px-2 py-1 rounded text-xs font-semibold bg-yellow-100 text-yellow-800">
            Borrador
        </span>
        @endif
    </div>
    
    <p class="text-sm text-gray-600 mb-3">
        {{ Str::limit($event->excerpt ?? $event->body, 100) }}
    </p>
    
    <div class="space-y-2 text-sm text-gray-500">
        <div class="flex items-center">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
            </svg>
            {{ $event->eventDetails?->start_date?->format('d/m/Y H:i') ?? 'Fecha por definir' }}
        </div>
        
        @if($event->eventDetails?->location)
        <div class="flex items-center">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
            </svg>
            {{ $event->eventDetails->location }}
        </div>
        @endif
        
        <div class="flex items-center">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
            </svg>
            Por: {{ $event->author->name }}
        </div>
    </div>
    
    @if(isset($slot) && $slot->isNotEmpty())
    <div class="mt-4">
        {{ $slot }}
    </div>
    @endif
</div>
