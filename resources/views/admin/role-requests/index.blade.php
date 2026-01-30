<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Solicitudes de Rol
            </h2>
            @if($pendingCount > 0)
            <span class="bg-red-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                {{ $pendingCount }} pendientes
            </span>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filtros -->
            <div class="mb-6 flex gap-3">
                <a href="{{ route('admin.role-requests.index') }}" class="px-4 py-2 rounded-lg {{ !request('status') ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Todas
                </a>
                <a href="{{ route('admin.role-requests.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-lg {{ request('status') === 'pending' ? 'bg-yellow-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Pendientes ({{ $pendingCount }})
                </a>
                <a href="{{ route('admin.role-requests.index', ['status' => 'approved']) }}" class="px-4 py-2 rounded-lg {{ request('status') === 'approved' ? 'bg-green-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Aprobadas
                </a>
                <a href="{{ route('admin.role-requests.index', ['status' => 'rejected']) }}" class="px-4 py-2 rounded-lg {{ request('status') === 'rejected' ? 'bg-red-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Rechazadas
                </a>
            </div>

            <!-- Lista de Solicitudes -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($requests->count() > 0)
                        <div class="space-y-4">
                            @foreach($requests as $request)
                                <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-2">
                                                <h3 class="font-semibold text-lg">{{ $request->user->name }}</h3>
                                                @if($request->status === 'pending')
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Pendiente</span>
                                                @elseif($request->status === 'approved')
                                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Aprobada</span>
                                                @else
                                                    <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">Rechazada</span>
                                                @endif
                                            </div>
                                            <p class="text-sm text-gray-600">{{ $request->user->email }}</p>
                                            <p class="text-sm text-gray-700 mt-2 line-clamp-2">{{ Str::limit($request->justification, 150) }}</p>
                                            <p class="text-xs text-gray-500 mt-2">Solicitado: {{ $request->created_at->diffForHumans() }}</p>
                                        </div>
                                        <a href="{{ route('admin.role-requests.show', $request) }}" class="ml-4 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm transition">
                                            Ver Detalle
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Paginación -->
                        <div class="mt-6">
                            {{ $requests->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No hay solicitudes con este estado.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
