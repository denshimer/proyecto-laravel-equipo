<x-dashboard-layout title="Dashboard | SICI-ISI" header="Panel de Control">
    
    <!-- Notificaciones de Solicitud de Rol -->
    @role('estudiante')
        @php
            $roleRequest = \App\Models\RoleRequest::where('user_id', auth()->id())
                ->latest()
                ->first();
        @endphp
        
        @if($roleRequest && $roleRequest->status === 'approved' && !auth()->user()->hasRole('docente'))
            <!-- Solicitud Aprobada - Completar Perfil -->
            <div class="mb-6 bg-green-500/10 border border-green-500/30 p-6 rounded-lg">
                <div class="flex items-start gap-4">
                    <svg class="w-8 h-8 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-green-400 mb-2">🎉 ¡Tu Solicitud fue Aprobada!</h3>
                        <p class="text-green-300 mb-4">Tu solicitud para ser docente ha sido aprobada. Completa tu perfil para comenzar a crear eventos.</p>
                        <a href="{{ route('student.role-request.complete') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition font-semibold">
                            Completar Perfil de Docente →
                        </a>
                    </div>
                </div>
            </div>
        @elseif($roleRequest && $roleRequest->status === 'rejected')
            <!-- Solicitud Rechazada -->
            <div class="mb-6 bg-red-500/10 border border-red-500/30 p-6 rounded-lg">
                <div class="flex items-start gap-4">
                    <svg class="w-8 h-8 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-red-400 mb-2">Solicitud No Aprobada</h3>
                        <p class="text-red-300">Tu solicitud para ser docente no fue aprobada.</p>
                        @if($roleRequest->admin_notes)
                            <div class="mt-3 p-3 bg-sici-card rounded border border-red-500/30">
                                <p class="text-sm font-semibold text-red-400">Motivo:</p>
                                <p class="text-red-300 mt-1">{{ $roleRequest->admin_notes }}</p>
                            </div>
                        @endif
                        <a href="{{ route('student.role-request.show') }}" class="inline-block mt-4 text-red-400 hover:text-red-300 underline">
                            Ver detalles de la solicitud →
                        </a>
                    </div>
                </div>
            </div>
        @endif
    @endrole

    <!-- Contenido normal del dashboard -->
    <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl p-6">
        <h3 class="text-2xl font-bold mb-4 text-white">Bienvenido, {{ auth()->user()->name }}</h3>
        <p class="text-gray-400">Explora eventos, noticias y gestiona tu perfil desde el menú lateral.</p>
    </div>

</x-dashboard-layout>
