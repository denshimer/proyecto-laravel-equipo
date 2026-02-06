<x-layout title="{{ $post->title }} | SICI-ISI">

    <article class="py-12 bg-sici-dark min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header --}}
            <div class="mb-8">
                <a href="{{ route('publications') }}" class="text-sici-red hover:text-sici-redDark transition inline-flex items-center mb-6">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Volver a Publicaciones
                </a>
                
                <div class="flex items-center gap-3 mb-4">
                    <span class="bg-sici-red text-white text-sm font-bold px-3 py-1 rounded uppercase">{{ $post->category->name }}</span>
                    <span class="text-sici-muted text-sm font-mono">{{ $post->created_at->format('d M Y') }}</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl font-display font-bold text-white mb-6">
                    {{ $post->title }}
                </h1>

                @if($post->excerpt)
                <p class="text-xl text-gray-400 leading-relaxed">
                    {{ $post->excerpt }}
                </p>
                @endif
            </div>

            {{-- Image --}}
            @if($post->image_path)
            <div class="mb-8 rounded-xl overflow-hidden border border-gray-800">
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-auto">
            </div>
            @endif

            {{-- Content --}}
            <div class="prose prose-invert prose-lg max-w-none mb-12">
                <div class="text-gray-300 leading-relaxed text-lg">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>

            {{-- Author Info --}}
            @if($post->author)
            <div class="border-t border-gray-800 pt-8 mt-12">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-sici-red flex items-center justify-center text-white font-bold text-2xl">
                        {{ strtoupper(substr($post->author->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm text-sici-muted">Publicado por</p>
                        <p class="text-lg font-semibold text-white">{{ $post->author->name }}</p>
                    </div>
                </div>
            </div>
            @endif

            {{-- Back to Publications --}}
            <div class="mt-12 text-center">
                <a href="{{ route('publications') }}" class="bg-sici-card hover:bg-sici-red border border-gray-800 hover:border-sici-red text-white px-8 py-3 rounded font-semibold transition inline-block">
                    Ver más publicaciones
                </a>
            </div>

        </div>
    </article>

</x-layout>
