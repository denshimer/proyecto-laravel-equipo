<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Papelera de Usuarios
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tabs -->
            <div class="mb-6 flex gap-2">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded-lg bg-white text-gray-700 hover:bg-gray-50">
                    Activos
                </a>
                <a href="{{ route('admin.users.trash') }}" class="px-4 py-2 rounded-lg bg-red-600 text-white">
                    Papelera
                </a>
            </div>

            <!-- Búsqueda -->
            <div class="mb-6 bg-white p-4 rounded-lg shadow">
                <form method="GET" action="{{ route('admin.users.trash') }}">
                    <div class="flex gap-2">
                        <input type="text" name="search" placeholder="Buscar por nombre o email..." 
                               value="{{ request('search') }}" 
                               class="flex-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg">
                            Buscar
                        </button>
                        @if(request('search'))
                            <a href="{{ route('admin.users.trash') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                                Limpiar
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Lista de usuarios eliminados -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Eliminado</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @foreach($user->roles as $role)
                                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-200 text-gray-800">
                                                        {{ $role->name }}
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $user->deleted_at->diffForHumans() }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex gap-2">
                                                    <!-- Restaurar -->
                                                    <form method="POST" action="{{ route('admin.users.restore', $user->id) }}">
                                                        @csrf
                                                        <button type="submit" class="text-green-600 hover:text-green-900" 
                                                                onclick="return confirm('¿Restaurar este usuario?')">
                                                            Restaurar
                                                        </button>
                                                    </form>
                                                    
                                                    <!-- Eliminar permanentemente -->
                                                    <form method="POST" action="{{ route('admin.users.force-delete', $user->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900" 
                                                                onclick="return confirm('¿ELIMINAR PERMANENTEMENTE este usuario? Esta acción NO se puede deshacer.')">
                                                            Eliminar
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
                        <div class="mt-4">
                            {{$users->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No hay usuarios en la papelera.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
