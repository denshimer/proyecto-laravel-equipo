<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de Solicitud
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Estado de la Solicitud -->
            <div class="mb-6">
                @if($roleRequest->status === 'pending')
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <p class="text-yellow-800 font-semibold">⏳ Solicitud Pendiente de Revisión</p>
                    </div>
                @elseif($roleRequest->status === 'approved')
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-green-800 font-semibold">✅ Solicitud Aprobada</p>
                        <p class="text-sm text-green-700 mt-1">Revisada por {{ $roleRequest->reviewer->name }} el {{ $roleRequest->reviewed_at->format('d/m/Y H:i') }}</p>
                    </div>
                @else
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <p class="text-red-800 font-semibold">❌ Solicitud Rechazada</p>
                        <p class="text-sm text-red-700 mt-1">Revisada por {{ $roleRequest->reviewer->name }} el {{ $roleRequest->reviewed_at->format('d/m/Y H:i') }}</p>
                        @if($roleRequest->admin_notes)
                            <p class="text-sm text-red-700 mt-2"><strong>Motivo:</strong> {{ $roleRequest->admin_notes }}</p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Información del Solicitante -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Información del Solicitante</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Nombre</p>
                            <p class="font-semibold">{{ $roleRequest->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="font-semibold">{{ $roleRequest->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Fecha de Registro</p>
                            <p class="font-semibold">{{ $roleRequest->user->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Rol Solicitado</p>
                            <p class="font-semibold">Docente</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Justificación -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Justificación</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $roleRequest->justification }}</p>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">Solicitado el {{ $roleRequest->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <!-- Acciones (solo si está pendiente) -->
            @if($roleRequest->status === 'pending')
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Acciones</h3>
                        
                        <div class="flex gap-4">
                            <!-- Aprobar -->
                            <form method="POST" action="{{ route('admin.role-requests.approve', $roleRequest) }}" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg transition font-semibold" onclick="return confirm('¿Aprobar esta solicitud? El usuario podrá completar su perfil de docente.')">
                                    ✅ Aprobar Solicitud
                                </button>
                            </form>

                            <!-- Rechazar -->
                            <button onclick="document.getElementById('reject-form').classList.remove('hidden')" class="flex-1 bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg transition font-semibold">
                                ❌ Rechazar Solicitud
                            </button>
                        </div>

                        <!-- Formulario de Rechazo (oculto) -->
                        <div id="reject-form" class="hidden mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <form method="POST" action="{{ route('admin.role-requests.reject', $roleRequest) }}">
                                @csrf
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Motivo del Rechazo *
                                </label>
                                <textarea name="admin_notes" rows="4" class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500" placeholder="Explica por qué se rechaza esta solicitud..." required></textarea>
                                <div class="flex gap-2 mt-3">
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition">
                                        Confirmar Rechazo
                                    </button>
                                    <button type="button" onclick="document.getElementById('reject-form').classList.add('hidden')" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition">
                                        Cancelar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('admin.role-requests.index') }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">
                    ← Volver a la Lista
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
