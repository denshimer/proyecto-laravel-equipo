<x-dashboard-layout title="Crear Nuevo Evento | SICI-ISI" header="Crear Nuevo Evento">
    
    <div class="mb-6">
        <a href="{{ route('teacher.events.index') }}" class="inline-flex items-center text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Volver a Mis Eventos
        </a>
    </div>

    <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl p-6">
        <form method="POST" action="{{ route('teacher.events.store') }}">
            @csrf

            <!-- Título -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-400">Título del Evento *</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                @error('title')
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

            <!-- Descripción -->
            <div class="mb-4">
                <label for="body" class="block text-sm font-medium text-gray-400">Descripción Completa *</label>
                <textarea name="body" id="body" rows="6" required
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">{{ old('body') }}</textarea>
                @error('body')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Fecha de Inicio -->
            <div class="mb-4">
                <label for="start_date" class="block text-sm font-medium text-gray-400">Fecha y Hora de Inicio *</label>
                <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date') }}" required
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                @error('start_date')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Fecha de Fin -->
            <div class="mb-4">
                <label for="end_date" class="block text-sm font-medium text-gray-400">Fecha y Hora de Fin</label>
                <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date') }}"
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                @error('end_date')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ubicación -->
            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-400">Ubicación *</label>
                <input type="text" name="location" id="location" value="{{ old('location') }}" required
                    placeholder="Ej: Aula 301, Auditorio Principal, Zoom (link en descripción)"
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                @error('location')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Cupo Máximo -->
            <div class="mb-4">
                <label for="max_attendees" class="block text-sm font-medium text-gray-400">Cupo Máximo de Asistentes</label>
                <input type="number" name="max_attendees" id="max_attendees" value="{{ old('max_attendees') }}" min="1"
                    placeholder="Dejar vacío para sin límite"
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                @error('max_attendees')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-lg p-4 mb-4">
                <p class="text-sm text-yellow-300">
                    ℹ️ El evento se creará como <strong>borrador</strong>. Podrás publicarlo después desde la lista de eventos.
                </p>
            </div>

            <!-- Botones -->
            <div class="flex gap-4">
                <button type="submit" class="bg-sici-red hover:bg-sici-redDark text-white px-6 py-3 rounded-lg transition font-semibold shadow-lg shadow-red-900/20">
                    Crear Evento
                </button>
                <a href="{{ route('teacher.events.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition font-semibold">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</x-dashboard-layout>
