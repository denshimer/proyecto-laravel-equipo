<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mi Solicitud de Rol
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            @if($request)
                <!-- Estado de la Solicitud -->
                @if($request->status === 'pending')
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-yellow-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-yellow-900 mb-2">Solicitud en Revisión</h3>
                                <p class="text-yellow-800">Tu solicitud está siendo revisada por un administrador. Te notificaremos cuando haya novedades.</p>
                                <p class="text-sm text-yellow-700 mt-2">Enviada el {{ $request->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                @elseif($request->status === 'approved')
                    <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <h3 class="font-semibold text-green-900 mb-2">¡Solicitud Aprobada!</h3>
                                <p class="text-green-800 mb-4">Tu solicitud ha sido aprobada. Ahora debes completar tu perfil de docente para comenzar a crear eventos.</p>
                                <a href="{{ route('student.role-request.complete') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition font-semibold">
                                    Completar Perfil de Docente →
                                </a>
                                <p class="text-sm text-green-700 mt-3">Aprobada el {{ $request->reviewed_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-red-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-red-900 mb-2">Solicitud Rechazada</h3>
                                <p class="text-red-800">Tu solicitud no fue aprobada.</p>
                                @if($request->admin_notes)
                                    <div class="mt-3 p-3 bg-white rounded border border-red-200">
                                        <p class="text-sm font-semibold text-red-900">Motivo:</p>
                                        <p class="text-red-800 mt-1">{{ $request->admin_notes }}</p>
                                    </div>
                                @endif
                                <p class="text-sm text-red-700 mt-3">Revisada el {{ $request->reviewed_at->format('d/m/Y H:i') }}</p>
                                <a href="{{ route('student.role-request.create') }}" class="inline-block mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
                                    Enviar Nueva Solicitud
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Justificación Enviada -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Tu Justificación</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $request->justification }}</p>
                        </div>
                    </div>
                </div>

            @else
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
                    <p class="text-gray-600 mb-4">No tienes ninguna solicitud de rol en este momento.</p>
                    <a href="{{ route('student.role-request.create') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg transition">
                        Solicitar Rol de Docente
                    </a>
                </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">
                    ← Volver al Inicio
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
