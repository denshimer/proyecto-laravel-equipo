<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Solicitar Rol de Docente
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            @if($existingRequest)
                <!-- Ya tiene solicitud pendiente -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-yellow-900 mb-2">Solicitud en Revisión</h3>
                            <p class="text-yellow-800">Ya tienes una solicitud pendiente de aprobación. Un administrador la revisará pronto.</p>
                            <a href="{{ route('student.role-request.show') }}" class="text-yellow-700 underline hover:text-yellow-900 mt-2 inline-block">
                                Ver estado de mi solicitud →
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Formulario de solicitud -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">¿Por qué quieres ser docente?</h3>
                            <p class="text-gray-600">Cuéntanos sobre tu experiencia, formación académica y qué te motiva a compartir conocimiento con la comunidad.</p>
                        </div>

                        <form method="POST" action="{{ route('student.role-request.store') }}">
                            @csrf

                            <div>
                                <label for="justification" class="block text-sm font-medium text-gray-700 mb-2">
                                    Justificación *
                                </label>
                                <textarea 
                                    id="justification" 
                                    name="justification" 
                                    rows="8" 
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" 
                                    placeholder="Ej: Soy Ingeniero en Sistemas con 5 años de experiencia en desarrollo web. He trabajado con Laravel, React y PostgreSQL. Me gustaría compartir mi conocimiento organizando talleres prácticos sobre tecnologías modernas..." 
                                    required>{{ old('justification') }}</textarea>
                                <p class="text-sm text-gray-500 mt-1">Mínimo 50 caracteres - Sé específico y honesto</p>
                                @error('justification')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <h4 class="font-semibold text-blue-900 mb-2">¿Qué sucede después?</h4>
                                <ol class="text-sm text-blue-800 space-y-1 list-decimal list-inside">
                                    <li>Un administrador revisará tu solicitud</li>
                                    <li>Si es aprobada, deberás completar tu perfil de docente</li>
                                    <li>Podrás crear y gestionar eventos educativos</li>
                                </ol>
                            </div>

                            <div class="flex items-center justify-between mt-6">
                                <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">
                                    Cancelar
                                </a>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition">
                                    Enviar Solicitud
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
