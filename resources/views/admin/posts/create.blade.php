<x-dashboard-layout title="Crear Nueva Publicación | SICI-ISI" header="Crear Nueva Publicación">
    
    <div class="mb-6">
        <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Volver a Publicaciones
        </a>
    </div>

    <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl p-6">
        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" id="postForm">
            @csrf

            <!-- Tipo de Publicación -->
            <div class="mb-6 p-4 bg-sici-dark border border-gray-700 rounded-lg">
                <label class="block text-sm font-medium text-gray-400 mb-2">Tipo de Publicación *</label>
                <div class="flex gap-4">
                    @foreach($contentTypes as $type)
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="content_type_id" value="{{ $type->id }}" 
                            {{ old('content_type_id', 1) == $type->id ? 'checked' : '' }}
                            class="content-type-radio h-4 w-4 text-sici-red focus:ring-sici-red bg-sici-dark border-gray-600"
                            onchange="toggleEventFields()">
                        <span class="ml-2 text-gray-300">{{ $type->name }}</span>
                    </label>
                    @endforeach
                </div>
                @error('content_type_id')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Título -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-400">Título *</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                @error('title')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Categoría -->
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-400">Categoría</label>
                <select name="category_id" id="category_id"
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                    <option value="">Sin categoría</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Imagen -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-400">Imagen</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-400
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-sici-red file:text-white
                    hover:file:bg-sici-redDark file:transition">
                <p class="mt-1 text-xs text-gray-500">PNG, JPG, JPEG (máx. 2MB)</p>
                @error('image')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Resumen -->
            <div class="mb-4">
                <label for="excerpt" class="block text-sm font-medium text-gray-400">Resumen Breve</label>
                <textarea name="excerpt" id="excerpt" rows="2"
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contenido -->
            <div class="mb-4">
                <label for="body" class="block text-sm font-medium text-gray-400">Contenido *</label>
                <textarea name="body" id="body" rows="10" required
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">{{ old('body') }}</textarea>
                @error('body')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campos de Evento (Ocultos por defecto) -->
            <div id="eventFields" class="mb-6 p-4 bg-blue-500/10 rounded-lg border border-blue-500/30" style="display: none;">
                <h3 class="text-lg font-semibold text-blue-400 mb-4">📅 Detalles del Evento</h3>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Fecha Inicio -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-400">Fecha y Hora Inicio *</label>
                        <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date') }}"
                            class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                        @error('start_date')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha Fin -->
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-400">Fecha y Hora Fin *</label>
                        <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date') }}"
                            class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                        @error('end_date')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Ubicación -->
                <div class="mb-4">
                    <label for="location" class="block text-sm font-medium text-gray-400">Ubicación *</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}" placeholder="Ej: Auditorio Principal"
                        class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                    @error('location')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Cupo Máximo -->
                    <div>
                        <label for="max_attendees" class="block text-sm font-medium text-gray-400">Cupo Máximo</label>
                        <input type="number" name="max_attendees" id="max_attendees" value="{{ old('max_attendees') }}" min="1" placeholder="Sin límite"
                            class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                        @error('max_attendees')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Link Externo -->
                    <div>
                        <label for="external_registration_link" class="block text-sm font-medium text-gray-400">Link de Inscripción Externa</label>
                        <input type="url" name="external_registration_link" id="external_registration_link" value="{{ old('external_registration_link') }}" 
                            placeholder="https://forms.google.com/..."
                            class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                        <p class="mt-1 text-xs text-gray-500">Si se proporciona, se usará este link en lugar del sistema interno</p>
                        @error('external_registration_link')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Opciones -->
            <div class="mb-6 space-y-2">
                <label class="flex items-center">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                        class="rounded border-gray-600 bg-sici-dark text-sici-red shadow-sm focus:border-sici-red focus:ring-sici-red">
                    <span class="ml-2 text-sm text-gray-300">✅ Publicar ahora</span>
                </label>
                
                <label class="flex items-center">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                        class="rounded border-gray-600 bg-sici-dark text-sici-red shadow-sm focus:border-sici-red focus:ring-sici-red">
                    <span class="ml-2 text-sm text-gray-300">⭐ Marcar como Destacado</span>
                </label>
            </div>

            <!-- Botones -->
            <div class="flex gap-4">
                <button type="submit" class="bg-sici-red hover:bg-sici-redDark text-white px-6 py-3 rounded-lg transition font-semibold shadow-lg shadow-red-900/20">
                    Crear Publicación
                </button>
                <a href="{{ route('admin.posts.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition font-semibold">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    <script>
        function toggleEventFields() {
            const contentTypeRadios = document.querySelectorAll('.content-type-radio');
            const eventFields = document.getElementById('eventFields');
            let selectedType = null;
            
            contentTypeRadios.forEach(radio => {
                if (radio.checked) {
                    selectedType = radio.value;
                }
            });
            
            // Si es tipo 2 (Evento), mostrar campos
            if (selectedType == '2') {
                eventFields.style.display = 'block';
                // Hacer campos requeridos
                document.getElementById('start_date').required = true;
                document.getElementById('end_date').required = true;
                document.getElementById('location').required = true;
            } else {
                eventFields.style.display = 'none';
                // Quitar requeridos
                document.getElementById('start_date').required = false;
                document.getElementById('end_date').required = false;
                document.getElementById('location').required = false;
            }
        }
        
        // Ejecutar al cargar la página
        document.addEventListener('DOMContentLoaded', toggleEventFields);
    </script>

</x-dashboard-layout>
