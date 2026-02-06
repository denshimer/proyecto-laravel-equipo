<x-layout title="{{ $post->title }} | SICI-ISI">

    <article class="py-12 bg-sici-dark min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header --}}
            <div class="mb-8">
                <a href="{{ route('events') }}" class="text-sici-red hover:text-sici-redDark transition inline-flex items-center mb-6">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Volver a Eventos
                </a>
                
                <div class="flex items-center gap-3 mb-4">
                    <span class="bg-purple-400/10 text-purple-400 text-sm font-bold px-3 py-1 rounded">Evento</span>
                    <span class="text-sici-muted text-sm font-mono">{{ $post->eventDetails->start_date->format('d M Y') }}</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl font-display font-bold text-white mb-4">
                    {{ $post->title }}
                </h1>
            </div>

            {{-- Image --}}
            @if($post->image_path)
            <div class="mb-8 rounded-xl overflow-hidden border border-gray-800">
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-auto">
            </div>
            @endif

            {{-- Event Details --}}
            <div class="bg-sici-card rounded-xl border border-gray-800 p-6 mb-8">
                <h3 class="text-xl font-bold text-white mb-4">Detalles del Evento</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-300">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">📅</span>
                        <div>
                            <p class="text-sm text-sici-muted">Fecha</p>
                            <p class="font-semibold">{{ $post->eventDetails->start_date->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">📍</span>
                        <div>
                            <p class="text-sm text-sici-muted">Ubicación</p>
                            <p class="font-semibold">{{ $post->eventDetails->location }}</p>
                        </div>
                    </div>
                    @if($post->eventDetails->max_attendees > 0)
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">👥</span>
                        <div>
                            <p class="text-sm text-sici-muted">Cupo</p>
                            <p class="font-semibold">{{ $post->eventDetails->max_attendees }} personas</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Content --}}
            <div class="prose prose-invert prose-lg max-w-none">
                <div class="text-gray-300 leading-relaxed">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>

            {{-- CTA --}}
            @auth
            <div class="mt-12 text-center bg-sici-card border border-sici-red rounded-xl p-8">
                <h3 class="text-2xl font-bold text-white mb-4">¿Interesado en participar?</h3>
                <a href="{{ route('student.events.index') }}" class="bg-sici-red hover:bg-sici-redDark text-white px-8 py-3 rounded font-semibold text-lg transition inline-block">
                    Ver más eventos
                </a>
            </div>
            @else
            <div class="mt-12 text-center bg-sici-card border border-gray-800 rounded-xl p-8">
                <h3 class="text-2xl font-bold text-white mb-4">Inicia sesión para registrarte</h3>
                <a href="{{ route('login') }}" class="bg-sici-red hover:bg-sici-redDark text-white px-8 py-3 rounded font-semibold text-lg transition inline-block">
                    Iniciar Sesión
                </a>
            </div>
            @endauth

        </div>
    </article>

</x-layout>
