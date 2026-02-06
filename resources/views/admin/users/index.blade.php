<x-dashboard-layout title="Gestión de Usuarios | SICI-ISI" header="Gestión de Usuarios">
    
    <!--Botón Atrás y Acciones -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Volver al Dashboard
        </a>
        <a href="{{ route('admin.users.create') }}" class="bg-sici-red hover:bg-sici-redDark text-white px-6 py-3 rounded-lg transition shadow-lg shadow-red-900/20 font-bold">
            ➕ Crear Usuario
        </a>
    </div>

    <x-alert type="success" />
    <x-alert type="error" />

    <!-- Tabs Activos/Papelera -->
    <div class="mb-6 flex gap-2">
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded-lg bg-sici-red text-white font-semibold">
            👥 Activos
        </a>
        <a href="{{ route('admin.users.trash') }}" class="px-4 py-2 rounded-lg bg-sici-card text-gray-400 hover:text-white hover:bg-gray-800 border border-gray-700 transition font-semibold">
            🗑️ Papelera
        </a>
    </div>

    <!-- Filtros -->
    <div class="bg-sici-card border border-gray-800 rounded-xl p-6 mb-6">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex gap-4">
            <input type="text" name="search" placeholder="Buscar por nombre o email..." 
                value="{{ request('search') }}"
                class="flex-1 bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
            
            <select name="role" class="bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                <option value="">Todos los roles</option>
                @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ request('role') === $role->name ? 'selected' : '' }}>
                    {{ ucfirst($role->name) }}
                </option>
                @endforeach
            </select>
            
            <button type="submit" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition font-semibold">
                Filtrar
            </button>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-600 hover:bg-gray-500 text-white px-6 py-2 rounded-lg transition font-semibold">
                Limpiar
            </a>
        </form>
    </div>

    <!-- Tabla de Usuarios -->
    <div class="bg-sici-card border border-gray-800 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-sici-dark/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-800/50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-white font-medium">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                {{ $user->hasRole('admin') || $user->hasRole('dev') ? 'bg-purple-500/10 text-purple-500' : '' }}
                                {{ $user->hasRole('docente') ? 'bg-blue-500/10 text-blue-500' : '' }}
                                {{ $user->hasRole('estudiante') ? 'bg-green-500/10 text-green-500' : '' }}">
                                {{ $user->roles->first()?->name ?? 'Sin rol' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                {{ $user->is_active ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }}">
                                {{ $user->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex gap-3">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-sici-red hover:text-sici-redDark transition font-medium">
                                    Editar
                                </a>
                                <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-yellow-400 hover:text-yellow-300 transition font-medium">
                                        {{ $user->is_active ? 'Desactivar' : 'Activar' }}
                                    </button>
                                </form>
                                @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" 
                                    onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 transition font-medium">
                                        Eliminar
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            No se encontraron usuarios.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 border-t border-gray-800">
            {{ $users->links() }}
        </div>
    </div>

</x-dashboard-layout>
