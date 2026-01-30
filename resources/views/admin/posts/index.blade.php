<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestión de Publicaciones') }}
            </h2>
            <a href="{{ route('admin.posts.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition">
                + Nueva Publicación
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert type="success" />
            <x-alert type="error" />

            <!-- Tabs Activos/Papelera -->
            <div class="mb-6 flex gap-2">
                <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 rounded-lg bg-indigo-600 text-white">
                    👥 Activos
                </a>
                <a href="{{ route('admin.posts.trash') }}" class="px-4 py-2 rounded-lg bg-white text-gray-700 hover:bg-gray-50 border">
                    🗑️ Papelera
                </a>
            </div>

            <!-- Filtros -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <form method="GET" action="{{ route('admin.posts.index') }}" class="flex gap-4 flex-wrap">
                    <input type="text" name="search" placeholder="Buscar publicaciones..." 
                        value="{{ request('search') }}"
                        class="flex-1 min-w-[200px] rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    
                    <select name="type" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Todos los tipos</option>
                        @foreach($contentTypes as $contentType)
                        <option value="{{ $contentType->id }}" {{ request('type') == $contentType->id ? 'selected' : '' }}>
                            {{ $contentType->name }}
                        </option>
                        @endforeach
                    </select>
                    
                    <select name="category" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Todas las categorías</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    
                    <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Todos los estados</option>
                        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Publicados</option>
                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Borradores</option>
                    </select>
                    
                    <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded transition">
                        Filtrar
                    </button>
                    <a href="{{ route('admin.posts.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded transition">
                        Limpiar
                    </a>
                </form>
            </div>

            <!-- Tabla de Publicaciones -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Título</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoría</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Autor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($posts as $post)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        @if($post->image_path)
                                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="" class="h-10 w-10 rounded object-cover">
                                        @endif
                                        <div>
                                            <div>{{ $post->title }}</div>
                                            @if($post->is_featured)
                                            <span class="px-2 py-1 text-xs font-semibold rounded bg-yellow-100 text-yellow-800">
                                                ⭐ Destacado
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $post->contentType->key === 'event' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $post->contentType->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($post->category)
                                    <span class="px-2 py-1 text-xs font-semibold rounded" style="background-color: {{ $post->category->color }}20; color: {{ $post->category->color }};">
                                        {{ $post->category->name }}
                                    </span>
                                    @else
                                    <span class="text-gray-400">Sin categoría</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $post->author->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $post->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $post->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $post->is_published ? 'Publicado' : 'Borrador' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.posts.show', $post) }}" class="text-blue-600 hover:text-blue-900">
                                            Ver
                                        </a>
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-indigo-600 hover:text-indigo-900">
                                            Editar
                                        </a>
                                        <form action="{{ route('admin.posts.toggle-publish', $post) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-yellow-600 hover:text-yellow-900">
                                                {{ $post->is_published ? 'Despublicar' : 'Publicar' }}
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline"
                                            onsubmit="return confirm('¿Estás seguro de eliminar esta publicación?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    No se encontraron publicaciones.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
