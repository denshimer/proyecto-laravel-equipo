<x-dashboard-layout title="Panel de Control | SICI-ISI" header="Panel de Control">
    
    <!-- Grid de Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Tarjeta: Total Usuarios -->
        <div class="bg-sici-card p-6 rounded-xl border border-gray-800 shadow-lg">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sici-muted text-sm font-mono uppercase">Total Usuarios</p>
                    <h3 class="text-3xl font-bold text-white mt-1">{{ $totalUsuarios }}</h3>
                </div>
                <div class="p-2 bg-green-500/10 rounded-lg text-green-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
            <div class="mt-3 text-xs text-gray-500">
                <span class="text-green-400">{{ $totalEstudiantes }}</span> estudiantes · 
                <span class="text-blue-400">{{ $totalDocentes }}</span> docentes
            </div>
        </div>

        <!-- Tarjeta: Eventos Totales -->
        <div class="bg-sici-card p-6 rounded-xl border border-gray-800 shadow-lg">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sici-muted text-sm font-mono uppercase">Eventos Totales</p>
                    <h3 class="text-3xl font-bold text-white mt-1">{{ $totalEventos }}</h3>
                </div>
                <div class="p-2 bg-purple-500/10 rounded-lg text-purple-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Tarjeta: Inscripciones Totales -->
        <div class="bg-sici-card p-6 rounded-xl border border-gray-800 shadow-lg">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sici-muted text-sm font-mono uppercase">Inscripciones Totales</p>
                    <h3 class="text-3xl font-bold text-white mt-1">{{ $totalInscripciones }}</h3>
                </div>
                <div class="p-2 bg-blue-500/10 rounded-lg text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Eventos Recientes (2/3 del ancho) -->
        <div class="lg:col-span-2 bg-sici-card rounded-xl border border-gray-800 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-white">📅 Eventos Recientes</h3>
                <a href="{{ route('admin.posts.index') }}" class="text-sm text-sici-red hover:text-sici-redDark transition">
                    Ver todos →
                </a>
            </div>

            @if($eventosRecientes->isEmpty())
                <p class="text-gray-500 text-center py-8">No hay eventos registrados.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-400">
                        <thead class="text-xs text-gray-500 uppercase bg-sici-dark/50">
                            <tr>
                                <th class="px-4 py-3 rounded-l-lg">Título</th>
                                <th class="px-4 py-3">Autor</th>
                                <th class="px-4 py-3">Fecha</th>
                                <th class="px-4 py-3 rounded-r-lg">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="space-y-2">
                            @foreach($eventosRecientes as $evento)
                            <tr class="border-b border-gray-800 hover:bg-gray-800/50 transition">
                                <td class="px-4 py-3 font-medium text-white">{{ Str::limit($evento->title, 40) }}</td>
                                <td class="px-4 py-3">{{ $evento->author->name }}</td>
                                <td class="px-4 py-3">
                                    {{ $evento->eventDetails?->start_date?->format('d/m/Y') ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-3">
                                    @if($evento->is_published)
                                        <span class="bg-green-500/10 text-green-500 px-2 py-1 rounded text-xs">Publicado</span>
                                    @else
                                        <span class="bg-yellow-500/10 text-yellow-500 px-2 py-1 rounded text-xs">Borrador</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Panel de Acciones Rápidas (1/3 del ancho) -->
        <div class="lg:col-span-1 bg-sici-card rounded-xl border border-gray-800 p-6 flex flex-col justify-center text-center">
            <div class="bg-sici-dark w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-700">
                <svg class="w-8 h-8 text-sici-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Acciones Rápidas</h3>
            <p class="text-gray-400 text-sm mb-6">Gestiona contenido y usuarios de forma rápida.</p>
            
            <div class="space-y-3">
                <a href="{{ route('admin.posts.create') }}" class="block w-full bg-sici-red hover:bg-sici-redDark text-white font-bold py-3 rounded-lg transition shadow-lg shadow-red-900/20">
                    📝 Nueva Publicación
                </a>
                <a href="{{ route('admin.users.index') }}" class="block w-full bg-sici-dark hover:bg-gray-800 text-white font-bold py-3 rounded-lg border border-gray-700 transition">
                    👥 Gestionar Usuarios
                </a>
                <a href="{{ route('admin.role-requests.index') }}" class="block w-full bg-sici-dark hover:bg-gray-800 text-white font-bold py-3 rounded-lg border border-gray-700 transition relative">
                    🎓 Solicitudes de Rol
                    @php
                        $pendingRequests = \App\Models\RoleRequest::where('status', 'pending')->count();
                    @endphp
                    @if($pendingRequests > 0)
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white px-2 py-1 rounded-full text-xs font-bold">{{ $pendingRequests }}</span>
                    @endif
                </a>
            </div>
        </div>

    </div>

</x-dashboard-layout>