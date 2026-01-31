<x-layout :title="$publication->title">
    <div class="bg-sici-dark text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Encabezado con imagen -->
            <div class="mb-8">
                <h1 class="text-4xl md:text-5xl font-display font-bold mb-4">{{ $publication->title }}</h1>
                <div class="flex items-center text-sici-muted text-sm font-mono">
                    <span>Publicado el {{ $publication->published_at->format('d/m/Y') }}</span>
                </div>
            </div>

            <div class="w-full h-96 rounded-lg overflow-hidden mb-8">
                <img src="{{ asset('images/card.jpeg') }}" alt="Imagen de la publicación" class="w-full h-full object-cover">
            </div>

            <!-- Contenido del post -->
            <div class="prose prose-invert prose-lg max-w-none">
                {!! $publication->content !!}
            </div>

            <!-- Botón de regreso -->
            <div class="mt-12 text-center">
                <a href="{{ route('publications') }}" class="text-sici-red font-bold tracking-wide hover:underline">
                    &larr; Volver a todas las publicaciones
                </a>
            </div>

        </div>
    </div>
</x-layout>
