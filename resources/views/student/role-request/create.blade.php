<x-dashboard-layout title="Solicitar Rol de Docente | SICI-ISI" header="Solicitar Rol de Docente">
    
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Volver al Dashboard
        </a>
    </div>

    @if($existingRequest)
        <!-- Ya tiene solicitud pendiente -->
        <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-lg p-6">
            <div class="flex items-start gap-3">
                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h3 class="font-semibold text-yellow-400 mb-2">Solicitud en Revisión</h3>
                    <p class="text-yellow-300">Ya tienes una solicitud pendiente de aprobación. Un administrador la revisará pronto.</p>
                    <a href="{{ route('student.role-request.show') }}" class="text-yellow-400 underline hover:text-yellow-300 mt-2 inline-block">
                        Ver estado de mi solicitud →
                    </a>
                </div>
            </div>
        </div>
    @else
        <!-- Formulario de solicitud -->
        <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl">
            <div class="p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-white mb-2">¿Por qué quieres ser docente?</h3>
                    <p class="text-gray-400">Cuéntanos sobre tu experiencia, formación académica y qué te motiva a compartir conocimiento con la comunidad.</p>
                </div>

                <form method="POST" action="{{ route('student.role-request.store') }}">
                    @csrf

                    <div>
                        <label for="justification" class="block text-sm font-medium text-gray-400 mb-2">
                            Justificación *
                        </label>
                        <textarea 
                            id="justification" 
                            name="justification" 
                            rows="8" 
                            class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition" 
                            placeholder="Ej: Soy Ingeniero en Sistemas con 5 años de experiencia en desarrollo web. He trabajado con Laravel, React y PostgreSQL. Me gustaría compartir mi conocimiento organizando talleres prácticos sobre tecnologías modernas..." 
                            required>{{ old('justification') }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Mínimo 50 caracteres - Sé específico y honesto</p>
                        @error('justification')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6 p-4 bg-blue-500/10 border border-blue-500/30 rounded-lg">
                        <h4 class="font-semibold text-blue-400 mb-2">¿Qué sucede después?</h4>
                        <ol class="text-sm text-blue-300 space-y-1 list-decimal list-inside">
                            <li>Un administrador revisará tu solicitud</li>
                            <li>Si es aprobada, deberás completar tu perfil de docente</li>
                            <li>Podrás crear y gestionar eventos educativos</li>
                        </ol>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-sici-red hover:bg-sici-redDark text-white px-6 py-3 rounded-lg transition font-semibold shadow-lg shadow-red-900/20">
                            Enviar Solicitud
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

</x-dashboard-layout>
