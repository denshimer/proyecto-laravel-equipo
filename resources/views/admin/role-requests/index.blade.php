<x-dashboard-layout title="Solicitudes de Rol | SICI-ISI" header="Solicitudes de Rol">
    
    <!-- Botón Atrás y Badge de Pendientes -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Volver al Dashboard
        </a>
        @if($pendingCount > 0)
        <span class="bg-red-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg shadow-red-900/20">
            {{ $pendingCount }} pendientes
        </span>
        @endif
    </div>

    <!-- Filtros -->
    <div class="mb-6 flex gap-3">
        <a href="{{ route('admin.role-requests.index') }}" class="px-4 py-2 rounded-lg font-semibold transition {{ !request('status') ? 'bg-sici-red text-white shadow-lg shadow-red-900/20' : 'bg-sici-card text-gray-400 hover:text-white hover:bg-gray-800 border border-gray-700' }}">
            Todas
        </a>
        <a href="{{ route('admin.role-requests.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-lg font-semibold transition {{ request('status') === 'pending' ? 'bg-yellow-600 text-white shadow-lg shadow-yellow-900/20' : 'bg-sici-card text-gray-400 hover:text-white hover:bg-gray-800 border border-gray-700' }}">
            Pendientes ({{ $pendingCount }})
        </a>
        <a href="{{ route('admin.role-requests.index', ['status' => 'approved']) }}" class="px-4 py-2 rounded-lg font-semibold transition {{ request('status') === 'approved' ? 'bg-green-600 text-white shadow-lg shadow-green-900/20' : 'bg-sici-card text-gray-400 hover:text-white hover:bg-gray-800 border border-gray-700' }}">
            Aprobadas
        </a>
        <a href="{{ route('admin.role-requests.index', ['status' => 'rejected']) }}" class="px-4 py-2 rounded-lg font-semibold transition {{ request('status') === 'rejected' ? 'bg-red-600 text-white shadow-lg shadow-red-900/20' : 'bg-sici-card text-gray-400 hover:text-white hover:bg-gray-800 border border-gray-700' }}">
            Rechazadas
        </a>
    </div>

    <!-- Lista de Solicitudes -->
    <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl">
        <div class="p-6">
            @if($requests->count() > 0)
                <div class="space-y-4">
                    @foreach($requests as $request)
                        <div class="border border-gray-700 rounded-lg p-4 hover:bg-gray-800/50 transition bg-sici-dark/30">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="font-semibold text-lg text-white">{{ $request->user->name }}</h3>
                                        @if($request->status === 'pending')
                                            <span class="bg-yellow-500/10 text-yellow-500 text-xs px-3 py-1 rounded-full font-semibold">Pendiente</span>
                                        @elseif($request->status === 'approved')
                                            <span class="bg-green-500/10 text-green-500 text-xs px-3 py-1 rounded-full font-semibold">Aprobada</span>
                                        @else
                                            <span class="bg-red-500/10 text-red-500 text-xs px-3 py-1 rounded-full font-semibold">Rechazada</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-400">{{ $request->user->email }}</p>
                                    <p class="text-sm text-gray-300 mt-2 line-clamp-2">{{ Str::limit($request->justification, 150) }}</p>
                                    <p class="text-xs text-gray-500 mt-2">Solicitado: {{ $request->created_at->diffForHumans() }}</p>
                                </div>
                                <a href="{{ route('admin.role-requests.show', $request) }}" class="ml-4 bg-sici-red hover:bg-sici-redDark text-white px-4 py-2 rounded-lg text-sm transition font-semibold shadow-lg shadow-red-900/20">
                                    Ver Detalle
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="mt-6 border-t border-gray-800 pt-4">
                    {{ $requests->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-gray-500 text-lg">No hay solicitudes con este estado.</p>
                </div>
            @endif
        </div>
    </div>

</x-dashboard-layout>
