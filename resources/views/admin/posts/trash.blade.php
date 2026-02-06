<x-dashboard-layout title="Papelera de Publicaciones | SICI-ISI" header="Papelera de Publicaciones">
    
    <!-- Botón Atrás -->
    <div class="mb-6">
        <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Volver a Publicaciones
        </a>
    </div>

    <!-- Tabs -->
    <div class="mb-6 flex gap-2">
        <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 rounded-lg bg-sici-card text-gray-400 hover:text-white hover:bg-gray-800 border border-gray-700 transition font-semibold">
            📄 Activos
        </a>
        <a href="{{ route('admin.posts.trash') }}" class="px-4 py-2 rounded-lg bg-red-600 text-white font-semibold">
            🗑️ Papelera
        </a>
    </div>

    <!-- Filtros -->
    <div class="mb-6 bg-sici-card border border-gray-800 p-6 rounded-xl">
        <form method="GET" action="{{ route('admin.posts.trash') }}">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="text" name="search" placeholder="Buscar por título..." 
                    value="{{ request('search') }}" 
                    class="bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                
                <select name="type" class="bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                    <option value="">Todos los tipos</option>
                    @foreach($contentTypes as $type)
                        <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
                
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-sici-red hover:bg-sici-redDark text-white px-6 py-2 rounded-lg transition font-semibold">
                        Filtrar
                    </button>
                    @if(request()->hasAny(['search', 'type']))
                        <a href="{{ route('admin.posts.trash') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition font-semibold">
                            Limpiar
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Lista de publicaciones eliminadas -->
    <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl">
        <div class="p-6">
            @if($posts->count() > 0)
                <div class="space-y-4">
                    @foreach($posts as $post)
                        <div class="border border-gray-700 rounded-lg p-4 bg-sici-dark/50 hover:bg-gray-800/50 transition">
                            <div class="flex items-start gap-4">
                                @if($post->image_url)
                                    <img src="{{ asset($post->image_url) }}" alt="{{ $post->title }}" 
                                         class="w-24 h-24 object-cover rounded border border-gray-700">
                                @endif
                                
                                <div class="flex-1">
                                    <h3 class="font-semibold text-lg text-white">{{ $post->title }}</h3>
                                    <p class="text-sm text-gray-400 mt-1">{{ Str::limit($post->content, 100) }}</p>
                                    <div class="flex gap-4 mt-2 text-xs text-gray-500">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                            {{ $post->contentType->name }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            {{ $post->author->name }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ $post->deleted_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col gap-2">
                                    <!-- Restaurar -->
                                    <form method="POST" action="{{ route('admin.posts.restore', $post->id) }}">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-lg shadow-green-900/20"
                                                onclick="return confirm('¿Restaurar esta publicación?')">
                                            ↩ Restaurar
                                        </button>
                                    </form>
                                    
                                    <!-- Eliminar permanentemente -->
                                    <form method="POST" action="{{ route('admin.posts.force-delete', $post->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-lg shadow-red-900/20"
                                                onclick="return confirm('¿ELIMINAR PERMANENTEMENTE? Esta acción NO se puede deshacer.')">
                                            ✕ Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="mt-6 border-t border-gray-800 pt-4">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    <p class="text-gray-500 text-lg">No hay publicaciones en la papelera.</p>
                </div>
            @endif
        </div>
    </div>

</x-dashboard-layout>
