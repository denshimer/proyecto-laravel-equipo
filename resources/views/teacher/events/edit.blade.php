<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Evento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('teacher.events.update', $event) }}">
                    @csrf
                    @method('PUT')

                    <!-- Título -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Título del Evento *</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Resumen -->
                    <div class="mb-4">
                        <label for="excerpt" class="block text-sm font-medium text-gray-700">Resumen Breve</label>
                        <textarea name="excerpt" id="excerpt" rows="2"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('excerpt', $event->excerpt) }}</textarea>
                        @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="mb-4">
                        <label for="body" class="block text-sm font-medium text-gray-700">Descripción Completa *</label>
                        <textarea name="body" id="body" rows="6" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('body', $event->body) }}</textarea>
                        @error('body')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha de Inicio -->
                    <div class="mb-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha y Hora de Inicio *</label>
                        <input type="datetime-local" name="start_date" id="start_date" 
                            value="{{ old('start_date', $event->eventDetails?->start_date?->format('Y-m-d\TH:i')) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('start_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha de Fin -->
                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Fecha y Hora de Fin</label>
                        <input type="datetime-local" name="end_date" id="end_date" 
                            value="{{ old('end_date', $event->eventDetails?->end_date?->format('Y-m-d\TH:i')) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('end_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ubicación -->
                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-700">Ubicación *</label>
                        <input type="text" name="location" id="location" value="{{ old('location', $event->eventDetails?->location) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cupo Máximo -->
                    <div class="mb-4">
                        <label for="max_attendees" class="block text-sm font-medium text-gray-700">Cupo Máximo de Asistentes</label>
                        <input type="number" name="max_attendees" id="max_attendees" 
                            value="{{ old('max_attendees', $event->eventDetails?->max_attendees) }}" min="1"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('max_attendees')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-4">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition">
                            Actualizar Evento
                        </button>
                        <a href="{{ route('teacher.events.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded transition">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
