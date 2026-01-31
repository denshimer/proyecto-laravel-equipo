<x-app-layout>
    <div class="flex h-screen bg-sici-dark overflow-hidden">

        <aside class="w-64 flex-shrink-0 bg-sici-card border-r border-gray-800 hidden md:flex flex-col">
            <div class="h-16 flex items-center justify-center border-b border-gray-800">
                <span class="text-sici-red font-display font-bold text-2xl tracking-wider">SICI ADMIN</span>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="#" class="flex items-center px-4 py-3 text-white bg-sici-red rounded-lg transition shadow-lg shadow-red-900/20">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Panel Principal
                </a>
                </nav>
            <div class="p-4 border-t border-gray-800">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 rounded-full bg-sici-red flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrador</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-xs font-bold text-red-500 border border-red-500/30 rounded hover:bg-red-500/10 transition">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto bg-sici-dark relative">
            <header class="bg-sici-card/50 backdrop-blur-md border-b border-gray-800 p-4 sticky top-0 z-10 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white">Panel de Control</h2>
            </header>

            <div class="p-8">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-sici-card p-6 rounded-xl border border-gray-800 shadow-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sici-muted text-sm font-mono uppercase">Publicaciones</p>
                                <h3 class="text-3xl font-bold text-white mt-1">{{ $stats['publications'] }}</h3>
                            </div>
                            <div class="p-2 bg-blue-500/10 rounded-lg text-blue-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-sici-card p-6 rounded-xl border border-gray-800 shadow-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sici-muted text-sm font-mono uppercase">Eventos Activos</p>
                                <h3 class="text-3xl font-bold text-white mt-1">{{ $stats['events'] }}</h3>
                            </div>
                            <div class="p-2 bg-purple-500/10 rounded-lg text-purple-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-sici-card p-6 rounded-xl border border-gray-800 shadow-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sici-muted text-sm font-mono uppercase">Usuarios Registrados</p>
                                <h3 class="text-3xl font-bold text-white mt-1">{{ $stats['users'] }}</h3>
                            </div>
                            <div class="p-2 bg-green-500/10 rounded-lg text-green-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 bg-sici-card rounded-xl border border-gray-800 p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-white">Últimas Publicaciones</h3>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-gray-400">
                                <thead class="text-xs text-gray-500 uppercase bg-sici-dark/50">
                                    <tr>
                                        <th class="px-4 py-3 rounded-l-lg">Título</th>
                                        <th class="px-4 py-3">Fecha</th>
                                        <th class="px-4 py-3">Estado</th>
                                        <th class="px-4 py-3 rounded-r-lg">Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="space-y-2">
                                    @forelse($recentPosts as $post)
                                    <tr class="border-b border-gray-800 hover:bg-gray-800/50 transition">
                                        <td class="px-4 py-3 font-medium text-white">{{ Str::limit($post->title, 30) }}</td>
                                        <td class="px-4 py-3">{{ $post->published_at->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3">
                                            @if($post->is_published)
                                                <span class="bg-green-500/10 text-green-500 px-2 py-1 rounded text-xs">Publicado</span>
                                            @else
                                                <span class="bg-yellow-500/10 text-yellow-500 px-2 py-1 rounded text-xs">Borrador</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <a href="{{ route('admin.publications.edit', $post) }}" class="text-blue-400 hover:text-white mr-2">Editar</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-3 text-center">No hay publicaciones recientes.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="lg:col-span-1 bg-sici-card rounded-xl border border-gray-800 p-6 flex flex-col justify-center text-center">
                        <div class="bg-sici-dark w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-700">
                            <svg class="w-8 h-8 text-sici-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Crear Nuevo Contenido</h3>
                        <p class="text-gray-400 text-sm mb-6">Agrega una noticia, evento o anuncio importante para la comunidad.</p>
                        
                        <div class="space-y-3">
                            <a href="{{ route('admin.publications.create') }}" class="block w-full bg-sici-red hover:bg-sici-redDark text-white font-bold py-3 rounded-lg transition shadow-lg shadow-red-900/20">
                                Nueva Publicación
                            </a>
                            <a href="{{ route('admin.events.create') }}" class="block w-full bg-sici-dark hover:bg-gray-800 text-white font-bold py-3 rounded-lg border border-gray-700 transition">
                                Nuevo Evento
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</x-app-layout>