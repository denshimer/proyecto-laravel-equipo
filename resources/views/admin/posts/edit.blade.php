<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Publicación') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data" id="postForm">
                    @csrf
                    @method('PUT')

                    <!-- Tipo de Publicación -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de Publicación *</label>
                        <div class="flex gap-4">
                            @foreach($contentTypes as $type)
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="content_type_id" value="{{ $type->id }}" 
                                    {{ old('content_type_id', $post->content_type_id) == $type->id ? 'checked' : '' }}
                                    class="content-type-radio h-4 w-4 text-indigo-600 focus:ring-indigo-500"
                                    onchange="toggleEventFields()">
                                <span class="ml-2 text-gray-700">{{ $type->name }}</span>
                            </label>
                            @endforeach
                        </div>
                        @error('content_type_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Título -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Título *</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Categoría -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</label>
                        <select name="category_id" id="category_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Sin categoría</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Imagen Actual y Nueva -->
                    <div class="mb-4">
                        @if($post->image_path)
                        <div class="mb-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Imagen Actual</label>
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="Imagen actual" class="h-32 rounded border">
                        </div>
                        @endif
                        
                        <label for="image" class="block text-sm font-medium text-gray-700">{{ $post->image_path ? 'Cambiar Imagen' : 'Agregar Imagen' }}</label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-indigo-50 file:text-indigo-700
                            hover:file:bg-indigo-100">
                        <p class="mt-1 text-xs text-gray-500">PNG, JPG, JPEG (máx. 2MB)</p>
                        @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Resumen -->
                    <div class="mb-4">
                        <label for="excerpt" class="block text-sm font-medium text-gray-700">Resumen Breve</label>
                        <textarea name="excerpt" id="excerpt" rows="2"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('excerpt', $post->excerpt) }}</textarea>
                        @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contenido -->
                    <div class="mb-4">
                        <label for="body" class="block text-sm font-medium text-gray-700">Contenido *</label>
                        <textarea name="body" id="body" rows="10" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('body', $post->body) }}</textarea>
                        @error('body')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Campos de Evento -->
                    <div id="eventFields" class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200" style="display: none;">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">📅 Detalles del Evento</h3>
                        
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha y Hora Inicio *</label>
                                <input type="datetime-local" name="start_date" id="start_date" 
                                    value="{{ old('start_date', $post->eventDetails?->start_date ? date('Y-m-d\TH:i', strtotime($post->eventDetails->start_date)) : '') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('start_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">Fecha y Hora Fin *</label>
                                <input type="datetime-local" name="end_date" id="end_date" 
                                    value="{{ old('end_date', $post->eventDetails?->end_date ? date('Y-m-d\TH:i', strtotime($post->eventDetails->end_date)) : '') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('end_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700">Ubicación *</label>
                            <input type="text" name="location" id="location" value="{{ old('location', $post->eventDetails?->location) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="max_attendees" class="block text-sm font-medium text-gray-700">Cupo Máximo</label>
                                <input type="number" name="max_attendees" id="max_attendees" value="{{ old('max_attendees', $post->eventDetails?->max_attendees) }}" min="1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('max_attendees')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="external_registration_link" class="block text-sm font-medium text-gray-700">Link de Inscripción Externa</label>
                                <input type="url" name="external_registration_link" id="external_registration_link" 
                                    value="{{ old('external_registration_link', $post->eventDetails?->external_registration_link) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('external_registration_link')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Opciones -->
                    <div class="mb-6 space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700">✅ Publicar ahora</span>
                        </label>
                        
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700">⭐ Marcar como Destacado</span>
                        </label>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-4">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded transition">
                            Actualizar Publicación
                        </button>
                        <a href="{{ route('admin.posts.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded transition">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
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
            
            if (selectedType == '2') {
                eventFields.style.display = 'block';
                document.getElementById('start_date').required = true;
                document.getElementById('end_date').required = true;
                document.getElementById('location').required = true;
            } else {
                eventFields.style.display = 'none';
                document.getElementById('start_date').required = false;
                document.getElementById('end_date').required = false;
                document.getElementById('location').required = false;
            }
        }
        
        document.addEventListener('DOMContentLoaded', toggleEventFields);
    </script>
</x-app-layout>
