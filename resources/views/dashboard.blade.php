<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inicio
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notificaciones de Solicitud de Rol -->
            @role('estudiante')
                @php
                    $roleRequest = \App\Models\RoleRequest::where('user_id', auth()->id())
                        ->latest()
                        ->first();
                @endphp
                
                @if($roleRequest && $roleRequest->status === 'approved' && !auth()->user()->hasRole('docente'))
                    <!-- Solicitud Aprobada - Completar Perfil -->
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-6 rounded-lg shadow-sm">
                        <div class="flex items-start gap-4">
                            <svg class="w-8 h-8 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-green-900 mb-2">🎉 ¡Tu Solicitud fue Aprobada!</h3>
                                <p class="text-green-800 mb-4">Tu solicitud para ser docente ha sido aprobada. Completa tu perfil para comenzar a crear eventos.</p>
                                <a href="{{ route('student.role-request.complete') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition font-semibold">
                                    Completar Perfil de Docente →
                                </a>
                            </div>
                        </div>
                    </div>
                @elseif($roleRequest && $roleRequest->status === 'rejected')
                    <!-- Solicitud Rechazada -->
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-6 rounded-lg shadow-sm">
                        <div class="flex items-start gap-4">
                            <svg class="w-8 h-8 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-red-900 mb-2">Solicitud No Aprobada</h3>
                                <p class="text-red-800">Tu solicitud para ser docente no fue aprobada.</p>
                                @if($roleRequest->admin_notes)
                                    <div class="mt-3 p-3 bg-white rounded border border-red-200">
                                        <p class="text-sm font-semibold text-red-900">Motivo:</p>
                                        <p class="text-red-800 mt-1">{{ $roleRequest->admin_notes }}</p>
                                    </div>
                                @endif
                                <a href="{{ route('student.role-request.show') }}" class="inline-block mt-4 text-red-700 hover:text-red-900 underline">
                                    Ver detalles de la solicitud →
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @endrole

            <!-- Contenido normal del dashboard -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Bienvenido, {{ auth()->user()->name }}</h3>
                    <p class="text-gray-600">Explora eventos, noticias y gestiona tu perfil desde el menú superior.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
