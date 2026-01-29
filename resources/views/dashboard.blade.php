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

                <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3 group-hover:text-sici-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Publicaciones
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3 group-hover:text-sici-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Eventos
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3 group-hover:text-sici-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Usuarios
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
                <button class="text-gray-400 hover:text-white relative">
                    <span class="absolute top-0 right-0 w-2 h-2 bg-sici-red rounded-full"></span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </button>
            </header>

            <div class="p-8">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-sici-card p-6 rounded-xl border border-gray-800 shadow-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sici-muted text-sm font-mono uppercase">Publicaciones</p>
                                <h3 class="text-3xl font-bold text-white mt-1">12</h3>
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
                                <h3 class="text-3xl font-bold text-white mt-1">3</h3>
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
                                <h3 class="text-3xl font-bold text-white mt-1">1,240</h3>
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
                            <button class="text-xs bg-sici-dark hover:bg-gray-800 text-white px-3 py-1 rounded border border-gray-700 transition">Ver todo</button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-gray-400">
                                <thead class="text-xs text-gray-500 uppercase bg-sici-dark/50">
                                    <tr>
                                        <th class="px-4 py-3 rounded-l-lg">Título</th>
                                        <th class="px-4 py-3">Autor</th>
                                        <th class="px-4 py-3">Estado</th>
                                        <th class="px-4 py-3 rounded-r-lg">Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="space-y-2">
                                    <tr class="border-b border-gray-800 hover:bg-gray-800/50 transition">
                                        <td class="px-4 py-3 font-medium text-white">Modernización Curricular</td>
                                        <td class="px-4 py-3">Admin</td>
                                        <td class="px-4 py-3"><span class="bg-green-500/10 text-green-500 px-2 py-1 rounded text-xs">Publicado</span></td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-400 hover:text-white mr-2">Editar</button>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-800 hover:bg-gray-800/50 transition">
                                        <td class="px-4 py-3 font-medium text-white">Bootcamp Frontend 2026</td>
                                        <td class="px-4 py-3">J. Perez</td>
                                        <td class="px-4 py-3"><span class="bg-yellow-500/10 text-yellow-500 px-2 py-1 rounded text-xs">Borrador</span></td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-400 hover:text-white mr-2">Editar</button>
                                        </td>
                                    </tr>
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
                            <button class="w-full bg-sici-red hover:bg-sici-redDark text-white font-bold py-3 rounded-lg transition shadow-lg shadow-red-900/20">
                                Nueva Publicación
                            </button>
                            <button class="w-full bg-sici-dark hover:bg-gray-800 text-white font-bold py-3 rounded-lg border border-gray-700 transition">
                                Nuevo Evento
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</x-app-layout>
