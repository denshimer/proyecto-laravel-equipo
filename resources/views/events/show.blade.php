<x-layout :title="$event->title">
    <div class="bg-sici-dark text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Encabezado -->
            <div class="mb-8">
                <h1 class="text-4xl md:text-5xl font-display font-bold mb-4">{{ $event->title }}</h1>
                <div class="font-mono text-sici-muted text-sm space-y-2">
                    <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}</p>
                    <p><strong>Ubicación:</strong> {{ $event->location }}</p>
                </div>
            </div>

            <!-- Imagen del Evento -->
            <div class="w-full h-96 rounded-lg overflow-hidden mb-8">
                <img src="{{ asset('images/card.jpeg') }}" alt="Imagen del evento" class="w-full h-full object-cover">
            </div>

            <!-- Descripción del evento -->
            <div class="prose prose-invert prose-lg max-w-none">
                <p>{{ $event->description }}</p>
            </div>

            <!-- Botón de regreso -->
            <div class="mt-12 text-center">
                <a href="{{ route('events') }}" class="text-sici-red font-bold tracking-wide hover:underline">
                    &larr; Volver a todos los eventos
                </a>
            </div>

        </div>
    </div>
</x-layout>
