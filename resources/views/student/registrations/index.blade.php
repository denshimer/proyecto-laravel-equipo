<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Inscripciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert type="success" />
            <x-alert type="error" />

            @if($registrations->isEmpty())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <p class="text-gray-500 mb-4">No tienes inscripciones a eventos aún.</p>
                <a href="{{ route('student.events.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition">
                    Explorar Eventos Disponibles
                </a>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($registrations as $registration)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="font-bold text-lg">{{ $registration->post->title }}</h3>
                        <span class="px-2 py-1 rounded text-xs font-semibold
                            {{ $registration->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($registration->status) }}
                        </span>
                    </div>
                    
                    <div class="space-y-2 text-sm text-gray-500 mb-4">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            {{ $registration->post->eventDetails?->start_date?->format('d/m/Y H:i') ?? 'Fecha por definir' }}
                        </div>
                        
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            {{ $registration->post->eventDetails?->location ?? 'Ubicación por definir' }}
                        </div>
                        
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            Por: {{ $registration->post->author->name }}
                        </div>
                        
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            Inscrito el: {{ $registration->created_at->format('d/m/Y') }}
                        </div>
                    </div>
                    
                    @if($registration->status === 'confirmed')
                    <form action="{{ route('student.registrations.cancel', $registration) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded transition"
                            onclick="return confirm('¿Estás seguro de cancelar esta inscripción?')">
                            Cancelar Inscripción
                        </button>
                    </form>
                    @else
                    <div class="bg-gray-100 text-gray-600 px-4 py-2 rounded text-center text-sm">
                        Inscripción cancelada
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                {{ $registrations->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
