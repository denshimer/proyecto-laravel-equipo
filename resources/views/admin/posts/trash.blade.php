<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Papelera de Publicaciones
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tabs -->
            <div class="mb-6 flex gap-2">
                <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 rounded-lg bg-white text-gray-700 hover:bg-gray-50">
                    Activos
                </a>
                <a href="{{ route('admin.posts.trash') }}" class="px-4 py-2 rounded-lg bg-red-600 text-white">
                    Papelera
                </a>
            </div>

            <!-- Filtros -->
            <div class="mb-6 bg-white p-4 rounded-lg shadow">
                <form method="GET" action="{{ route('admin.posts.trash') }}">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="text" name="search" placeholder="Buscar por título..." 
                               value="{{ request('search') }}" 
                               class="rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        
                        <select name="type" class="rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Todos los tipos</option>
                            @foreach($contentTypes as $type)
                                <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        
                        <div class="flex gap-2">
                            <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg">
                                Filtrar
                            </button>
                            @if(request()->hasAny(['search', 'type']))
                                <a href="{{ route('admin.posts.trash') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                                    Limpiar
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <!-- Lista de publicaciones eliminadas -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($posts->count() > 0)
                        <div class="space-y-4">
                            @foreach($posts as $post)
                                <div class="border rounded-lg p-4 bg-gray-50">
                                    <div class="flex items-start gap-4">
                                        @if($post->image_url)
                                            <img src="{{ asset($post->image_url) }}" alt="{{ $post->title }}" 
                                                 class="w-24 h-24 object-cover rounded">
                                        @endif
                                        
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-lg">{{ $post->title }}</h3>
                                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($post->content, 100) }}</p>
                                            <div class="flex gap-3 mt-2 text-xs text-gray-500">
                                                <span>Tipo: {{ $post->contentType->name }}</span>
                                                <span>Autor: {{ $post->author->name }}</span>
                                                <span>Eliminado: {{ $post->deleted_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-col gap-2">
                                            <!-- Restaurar -->
                                            <form method="POST" action="{{ route('admin.posts.restore', $post->id) }}">
                                                @csrf
                                                <button type="submit" 
                                                        class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm"
                                                        onclick="return confirm('¿Restaurar esta publicación?')">
                                                    Restaurar
                                                </button>
                                            </form>
                                            
                                            <!-- Eliminar permanentemente -->
                                            <form method="POST" action="{{ route('admin.posts.force-delete', $post->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm"
                                                        onclick="return confirm('¿ELIMINAR PERMANENTEMENTE? Esta acción NO se puede deshacer.')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Paginación -->
                        <div class="mt-6">
                            {{ $posts->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No hay publicaciones en la papelera.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
