<x-dashboard-layout title="Papelera de Usuarios | SICI-ISI" header="Papelera de Usuarios">
    
    <!-- Botón Atrás -->
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Volver a Usuarios
        </a>
    </div>

    <!-- Tabs -->
    <div class="mb-6 flex gap-2">
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded-lg bg-sici-card text-gray-400 hover:text-white hover:bg-gray-800 border border-gray-700 transition font-semibold">
            👥 Activos
        </a>
        <a href="{{ route('admin.users.trash') }}" class="px-4 py-2 rounded-lg bg-red-600 text-white font-semibold">
            🗑️ Papelera
        </a>
    </div>

    <!-- Búsqueda -->
    <div class="mb-6 bg-sici-card border border-gray-800 p-6 rounded-xl">
        <form method="GET" action="{{ route('admin.users.trash') }}">
            <div class="flex gap-2">
                <input type="text" name="search" placeholder="Buscar por nombre o email..." 
                       value="{{ request('search') }}" 
                       class="flex-1 bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                <button type="submit" class="bg-sici-red hover:bg-sici-redDark text-white px-6 py-2 rounded-lg transition font-semibold">
                    Buscar
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.users.trash') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition font-semibold">
                        Limpiar
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Lista de usuarios eliminados -->
    <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl">
        <div class="p-6">
            @if($users->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-sici-dark/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Eliminado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-800/50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-white">{{ $user->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-300">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @foreach($user->roles as $role)
                                            <span class="px-2 py-1 text-xs rounded-full bg-gray-700 text-gray-300">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                        {{ $user->deleted_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex gap-3">
                                            <!-- Restaurar -->
                                            <form method="POST" action="{{ route('admin.users.restore', $user->id) }}">
                                                @csrf
                                                <button type="submit" class="text-green-400 hover:text-green-300 transition font-semibold" 
                                                        onclick="return confirm('¿Restaurar este usuario?')">
                                                    ↩ Restaurar
                                                </button>
                                            </form>
                                            
                                            <!-- Eliminar permanentemente -->
                                            <form method="POST" action="{{ route('admin.users.force-delete', $user->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 transition font-semibold" 
                                                        onclick="return confirmreturn('¿ELIMINAR PERMANENTEMENTE este usuario? Esta acción NO se puede deshacer.')">
                                                    ✕ Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-6 border-t border-gray-800 pt-4">
                    {{ $users->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    <p class="text-gray-500 text-lg">No hay usuarios en la papelera.</p>
                </div>
            @endif
        </div>
    </div>

</x-dashboard-layout>
