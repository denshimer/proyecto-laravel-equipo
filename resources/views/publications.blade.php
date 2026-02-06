<x-layout title="Publicaciones | SICI-ISI">

    <section class="py-12 bg-sici-dark min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-10 border-b border-gray-800 pb-4">
                <h1 class="text-3xl md:text-4xl font-display font-bold text-white">
                    Publicaciones
                </h1>
                <p class="text-sici-muted mt-2">Mantente al día con las últimas noticias de la sociedad.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2">
                    @if($featured)
                    <article class="bg-sici-card rounded-xl overflow-hidden border border-gray-800 hover:border-sici-red transition duration-300 shadow-2xl group">
                        <div class="h-64 md:h-96 overflow-hidden relative">
                            <div class="absolute inset-0 bg-sici-dark/20 group-hover:bg-transparent transition z-10"></div>
                            @if($featured->image_path)
                                <img src="{{ asset('storage/' . $featured->image_path) }}" alt="{{ $featured->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                            @else
                                <img src="{{ asset('images/card.jpeg') }}" alt="{{ $featured->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                            @endif
                        </div>
                        
                        <div class="p-8">
                            <div class="flex items-center space-x-2 mb-4">
                                <span class="bg-sici-red text-white text-xs font-bold px-2 py-1 rounded uppercase tracking-wide">Nuevo</span>
                                <span class="text-sici-muted text-sm font-mono">{{ $featured->created_at->format('d M Y') }}</span>
                            </div>
                            
                            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4 font-display">
                                {{ $featured->title }}
                            </h2>
                            
                            <p class="text-gray-400 leading-relaxed mb-6">
                                {{ $featured->excerpt }}
                            </p>

                            <a href="{{ route('publications.show', $featured) }}" class="inline-flex items-center text-sici-red font-bold hover:text-white transition">
                                Leer artículo completo 
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </article>
                    @else
                        <div class="bg-sici-card p-10 rounded border border-gray-800 text-center">
                            <p class="text-gray-400">No hay publicaciones destacadas.</p>
                        </div>
                    @endif
                </div>

                <div class="lg:col-span-1">
                    <h3 class="text-xl font-bold text-white mb-6 border-l-4 border-sici-red pl-3">
                        Más Recientes
                    </h3>

                    <div class="flex flex-col space-y-6">
                        
                        @forelse($others as $post)
                        <article class="bg-sici-card rounded-lg overflow-hidden border border-gray-800 hover:border-gray-600 transition group flex flex-col md:flex-row lg:flex-col">
                            <div class="h-40 overflow-hidden w-full relative">
                                @if($post->image_path)
                                    <img src="{{ asset('storage/' . $post->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <img src="{{ asset('images/card.jpeg') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @endif
                            </div>
                            <div class="p-5 flex flex-col justify-center">
                                <span class="text-sici-muted text-xs font-mono mb-1">{{ $post->created_at->format('d M Y') }}</span>
                                <h4 class="text-lg font-bold text-white leading-tight group-hover:text-sici-red transition">
                                    <a href="{{ route('publications.show', $post) }}">{{ $post->title }}</a>
                                </h4>
                            </div>
                        </article>
                        @empty
                            <p class="text-gray-500 text-sm">No hay más noticias antiguas.</p>
                        @endforelse

                    </div>
                </div>

            </div>
        </div>
    </section>

</x-layout>