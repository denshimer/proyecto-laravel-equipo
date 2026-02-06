<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Completar Perfil de Docente
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <h3 class="font-semibold text-green-900 mb-2">🎉 ¡Solicitud Aprobada!</h3>
                        <p class="text-green-800">Tu solicitud para ser docente ha sido aprobada. Por favor completa los siguientes datos para finalizar tu perfil.</p>
                    </div>

                    <form method="POST" action="{{ route('student.role-request.store-profile') }}">
                        @csrf

                        <!-- Grado Académico -->
                        <div class="mb-4">
                            <label for="academic_degree" class="block text-sm font-medium text-gray-700 mb-2">
                                Grado Académico *
                            </label>
                            <select name="academic_degree" id="academic_degree" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">-- Selecciona --</option>
                                <option value="Ing." {{ old('academic_degree') == 'Ing.' ? 'selected' : '' }}>Ingeniero (Ing.)</option>
                                <option value="Lic." {{ old('academic_degree') == 'Lic.' ? 'selected' : '' }}>Licenciado (Lic.)</option>
                                <option value="MSc." {{ old('academic_degree') == 'MSc.' ? 'selected' : '' }}>Magister (MSc.)</option>
                                <option value="PhD." {{ old('academic_degree') == 'PhD.' ? 'selected' : '' }}>Doctor (PhD.)</option>
                            </select>
                            @error('academic_degree')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Especialidad -->
                        <div class="mb-4">
                            <label for="specialty" class="block text-sm font-medium text-gray-700 mb-2">
                                Especialidad Principal *
                            </label>
                            <input type="text" name="specialty" id="specialty" value="{{ old('specialty') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ej: Inteligencia Artificial, Redes, Desarrollo Web" required>
                            @error('specialty')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Teléfono -->
                        <div class="mb-6">
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Celular de Contacto *
                            </label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ej: +591 12345678" required>
                            @error('phone')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg transition font-semibold">
                            Finalizar y Convertirse en Docente
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
