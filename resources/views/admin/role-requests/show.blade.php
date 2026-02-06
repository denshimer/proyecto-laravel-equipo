<x-dashboard-layout title="Detalle de Solicitud | SICI-ISI" header="Detalle de Solicitud">
    
    <!-- Botón Atrás -->
    <div class="mb-6">
        <a href="{{ route('admin.role-requests.index') }}" class="inline-flex items-center text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Volver a Solicitudes
        </a>
    </div>

    <!-- Estado de la Solicitud -->
    <div class="mb-6">
        @if($roleRequest->status === 'pending')
            <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-lg p-4">
                <p class="text-yellow-500 font-semibold">⏳ Solicitud Pendiente de Revisión</p>
            </div>
        @elseif($roleRequest->status === 'approved')
            <div class="bg-green-500/10 border border-green-500/30 rounded-lg p-4">
                <p class="text-green-500 font-semibold">✅ Solicitud Aprobada</p>
                <p class="text-sm text-green-400 mt-1">Revisada por {{ $roleRequest->reviewer->name }} el {{ $roleRequest->reviewed_at->format('d/m/Y H:i') }}</p>
            </div>
        @else
            <div class="bg-red-500/10 border border-red-500/30 rounded-lg p-4">
                <p class="text-red-500 font-semibold">❌ Solicitud Rechazada</p>
                <p class="text-sm text-red-400 mt-1">Revisada por {{ $roleRequest->reviewer->name }} el {{ $roleRequest->reviewed_at->format('d/m/Y H:i') }}</p>
                @if($roleRequest->admin_notes)
                    <p class="text-sm text-red-400 mt-2"><strong>Motivo:</strong> {{ $roleRequest->admin_notes }}</p>
                @endif
            </div>
        @endif
    </div>

    <!-- Información del Solicitante -->
    <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl mb-6">
        <div class="p-6">
            <h3 class="text-lg font-semibold mb-4 text-white">Información del Solicitante</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Nombre</p>
                    <p class="font-semibold text-white">{{ $roleRequest->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-semibold text-white">{{ $roleRequest->user->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Fecha de Registro</p>
                    <p class="font-semibold text-white">{{ $roleRequest->user->created_at->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Rol Solicitado</p>
                    <p class="font-semibold text-white">Docente</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Justificación -->
    <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl mb-6">
        <div class="p-6">
            <h3 class="text-lg font-semibold mb-4 text-white">Justificación</h3>
            <div class="bg-sici-dark/50 p-4 rounded-lg border border-gray-700">
                <p class="text-gray-300 whitespace-pre-wrap">{{ $roleRequest->justification }}</p>
            </div>
            <p class="text-sm text-gray-500 mt-2">Solicitado el {{ $roleRequest->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <!-- Acciones (solo si está pendiente) -->
    @if($roleRequest->status === 'pending')
        <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4 text-white">Acciones</h3>
                
                <div class="flex gap-4">
                    <!-- Aprobar -->
                    <form method="POST" action="{{ route('admin.role-requests.approve', $roleRequest) }}" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg transition font-semibold shadow-lg shadow-green-900/20" onclick="return confirm('¿Aprobar esta solicitud? El usuario podrá completar su perfil de docente.')">
                            ✅ Aprobar Solicitud
                        </button>
                    </form>

                    <!-- Rechazar -->
                    <button onclick="document.getElementById('reject-form').classList.remove('hidden')" class="flex-1 bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg transition font-semibold shadow-lg shadow-red-900/20">
                        ❌ Rechazar Solicitud
                    </button>
                </div>

                <!-- Formulario de Rechazo (oculto) -->
                <div id="reject-form" class="hidden mt-4 p-4 bg-red-500/10 border border-red-500/30 rounded-lg">
                    <form method="POST" action="{{ route('admin.role-requests.reject', $roleRequest) }}">
                        @csrf
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Motivo del Rechazo *
                        </label>
                        <textarea name="admin_notes" rows="4" class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-red-500 focus:ring-red-500" placeholder="Explica por qué se rechaza esta solicitud..." required></textarea>
                        <div class="flex gap-2 mt-3">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition font-semibold">
                                Confirmar Rechazo
                            </button>
                            <button type="button" onclick="document.getElementById('reject-form').classList.add('hidden')" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition font-semibold">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

</x-dashboard-layout>
