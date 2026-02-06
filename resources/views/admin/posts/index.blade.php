<x-dashboard-layout title="Gestión de Publicaciones | SICI-ISI" header="Gestión de Publicaciones">
    
    <!-- Botón Atrás y Acciones -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Volver al Dashboard
        </a>
        <a href="{{ route('admin.posts.create') }}" class="bg-sici-red hover:bg-sici-redDark text-white px-6 py-3 rounded-lg transition shadow-lg shadow-red-900/20 font-bold">
            + Nueva Publicación
        </a>
    </div>

    <x-alert type="success" />
    <x-alert type="error" />

    <!-- Tabs Activos/Papelera -->
    <div class="mb-6 flex gap-2">
        <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 rounded-lg bg-sici-red text-white font-semibold">
            📄 Activos
        </a>
        <a href="{{ route('admin.posts.trash') }}" class="px-4 py-2 rounded-lg bg-sici-card text-gray-400 hover:text-white hover:bg-gray-800 border border-gray-700 transition font-semibold">
            🗑️ Papelera
        </a>
    </div>

    <!-- Filtros -->
    <div class="bg-sici-card border border-gray-800 rounded-xl p-6 mb-6">
        <form method="GET" action="{{ route('admin.posts.index') }}" class="flex gap-4 flex-wrap">
            <input type="text" name="search" placeholder="Buscar publicaciones..." 
                value="{{ request('search') }}"
                class="flex-1 min-w-[200px] bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
            
            <select name="type" class="bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                <option value="">Todos los tipos</option>
                @foreach($contentTypes as $contentType)
                <option value="{{ $contentType->id }}" {{ request('type') == $contentType->id ? 'selected' : '' }}>
                    {{ $contentType->name }}
                </option>
                @endforeach
            </select>
            
            <select name="category" class="bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                <option value="">Todas las categorías</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            
            <select name="status" class="bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                <option value="">Todos los estados</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Publicados</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Borradores</option>
            </select>
            
            <button type="submit" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition font-semibold">
                Filtrar
            </button>
            <a href="{{ route('admin.posts.index') }}" class="bg-gray-600 hover:bg-gray-500 text-white px-6 py-2 rounded-lg transition font-semibold">
                Limpiar
            </a>
        </form>
    </div>

    <!-- Tabla de Publicaciones -->
    <div class="bg-sici-card border border-gray-800 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-sici-dark/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse($posts as $post)
                    <tr class="hover:bg-gray-800/50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="" class="h-12 w-12 rounded-lg object-cover border border-gray-700">
                                @endif
                                <div>
                                    <div class="text-white font-medium">{{ $post->title }}</div>
                                    @if($post->is_featured)
                                    <span class="px-2 py-0.5 text-xs font-semibold rounded bg-yellow-500/10 text-yellow-500 inline-block mt-1">
                                        ⭐ Destacado
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                {{ $post->contentType->key === 'event' ? 'bg-purple-500/10 text-purple-500' : 'bg-blue-500/10 text-blue-500' }}">
                                {{ $post->contentType->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($post->category)
                            <span class="px-2 py-1 text-xs font-semibold rounded" style="background-color: {{ $post->category->color }}20; color: {{ $post->category->color }};">
                                {{ $post->category->name }}
                            </span>
                            @else
                            <span class="text-gray-500 text-sm">Sin categoría</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ $post->author->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-400 text-sm">
                            {{ $post->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                {{ $post->is_published ? 'bg-green-500/10 text-green-500' : 'bg-yellow-500/10 text-yellow-500' }}">
                                {{ $post->is_published ? 'Publicado' : 'Borrador' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex gap-3">
                                <a href="{{ route('admin.posts.show', $post) }}" class="text-blue-400 hover:text-blue-300 transition font-medium">
                                    Ver
                                </a>
                                <a href="{{ route('admin.posts.edit', $post) }}" class="text-sici-red hover:text-sici-redDark transition font-medium">
                                    Editar
                                </a>
                                <form action="{{ route('admin.posts.toggle-publish', $post) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-yellow-400 hover:text-yellow-300 transition font-medium">
                                        {{ $post->is_published ? 'Despublicar' : 'Publicar' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline"
                                    onsubmit="return confirm('¿Estás seguro de eliminar esta publicación?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 transition font-medium">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            No se encontraron publicaciones.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 border-t border-gray-800">
            {{ $posts->links() }}
        </div>
    </div>

</x-dashboard-layout>
