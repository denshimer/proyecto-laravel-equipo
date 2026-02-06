<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->contentType->name }}: {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-alert type="success" />
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Información Principal -->
                <div class="mb-6">
                    @if($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover rounded-lg mb-4">
                    @endif
                    
                    <div class="flex gap-2 mb-4">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            {{ $post->contentType->key === 'event' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $post->contentType->name }}
                        </span>
                        
                        @if($post->category)
                        <span class="px-3 py-1 rounded text-sm font-semibold" 
                            style="background-color: {{ $post->category->color }}20; color: {{ $post->category->color }};">
                            {{ $post->category->name }}
                        </span>
                        @endif
                        
                        @if($post->is_featured)
                        <span class="px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                            ⭐ Destacado
                        </span>
                        @endif
                        
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            {{ $post->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $post->is_published ? 'Publicado' : 'Borrador' }}
                        </span>
                    </div>

                    <h1 class="text-2xl font-bold mb-2">{{ $post->title }}</h1>
                    
                    <p class="text-gray-600 mb-4">
                        Por {{ $post->author->name }} • {{ $post->created_at->format('d/m/Y H:i') }}
                    </p>

                    @if($post->excerpt)
                    <p class="text-lg text-gray-700 mb-4 italic">{{ $post->excerpt }}</p>
                    @endif

                    <div class="prose max-w-none">
                        {!! nl2br(e($post->body)) !!}
                    </div>
                </div>

                <!-- Detalles del Evento (si es evento) -->
                @if($post->contentType->key === 'event' && $post->eventDetails)
                <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <h3 class="text-lg font-semibold mb-4">📅 Información del Evento</h3>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-sm text-gray-600">Fecha Inicio</p>
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($post->eventDetails->start_date)->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Fecha Fin</p>
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($post->eventDetails->end_date)->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm text-gray-600">Ubicación</p>
                        <p class="font-semibold">📍 {{ $post->eventDetails->location }}</p>
                    </div>

                    @if($post->eventDetails->max_attendees)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600">Cupo</p>
                        <p class="font-semibold">
                            {{ $post->registrations->count() }} / {{ $post->eventDetails->max_attendees }} inscritos
                        </p>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                            <div class="bg-blue-600 h-2 rounded-full" 
                                style="width: {{ ($post->registrations->count() / $post->eventDetails->max_attendees) * 100 }}%">
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($post->eventDetails->external_registration_link)
                    <div>
                        <p class="text-sm text-gray-600 mb-2">Inscripción Externa</p>
                        <a href="{{ $post->eventDetails->external_registration_link }}" target="_blank" 
                            class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition">
                            🔗 Ir al Formulario de Inscripción
                        </a>
                    </div>
                    @endif
                </div>

                <!-- Lista de Inscritos (si es evento interno) -->
                @if($post->contentType->key === 'event' && !$post->eventDetails->external_registration_link && $post->registrations->isNotEmpty())
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-4">👥 Inscritos ({{ $post->registrations->count() }})</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Nombre</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Email</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Estado</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Fecha</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($post->registrations as $registration)
                                <tr>
                                    <td class="px-4 py-2">{{ $registration->user->name }}</td>
                                    <td class="px-4 py-2">{{ $registration->user->email }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            {{ $registration->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($registration->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">{{ $registration->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                @endif

                <!-- Acciones -->
                <div class="mt-6 flex gap-4">
                    <a href="{{ route('admin.posts.edit', $post) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition">
                        ✏️ Editar
                    </a>
                    <form action="{{ route('admin.posts.toggle-publish', $post) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded transition">
                            {{ $post->is_published ? '📥 Despublicar' : '📤 Publicar' }}
                        </button>
                    </form>
                    <a href="{{ route('admin.posts.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded transition">
                        ← Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
