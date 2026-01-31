<x-layout title="Eventos | SICI-ISI">

    <section class="py-12 bg-sici-dark min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-16">
                <h1 class="text-3xl md:text-5xl font-display font-bold text-white mb-4">
                    Próximos Eventos
                </h1>
                <p class="text-sici-muted text-lg max-w-2xl mx-auto">
                    Talleres, conferencias y hackathons. No te pierdas las actividades que tenemos preparadas para ti.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse($events as $event)
                    <article class="bg-sici-card rounded-xl overflow-hidden border border-gray-800 hover:border-sici-red transition duration-300 group shadow-lg flex flex-col h-full">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ asset('images/card.jpeg') }}" alt="{{ $event->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                            
                            <div class="absolute top-4 right-4 bg-sici-dark/90 backdrop-blur-sm border border-sici-red rounded-lg p-2 text-center min-w-[70px] shadow-xl">
                                <span class="block text-2xl font-bold text-white font-display">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                                <span class="block text-xs font-bold text-sici-red uppercase tracking-wider">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</span>
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <div class="mb-3">
                                <span class="text-xs font-bold text-purple-400 bg-purple-400/10 px-2 py-1 rounded">Evento</span>
                            </div>

                            <h3 class="text-xl font-bold text-white mb-3 group-hover:text-sici-red transition">
                                <a href="{{ route('events.show', $event) }}">{{ $event->title }}</a>
                            </h3>
                            
                            <p class="text-gray-400 text-sm mb-6 flex-grow">
                                {{ Str::limit($event->description, 100) }}
                            </p>

                            <div class="border-t border-gray-700 pt-4 flex items-center justify-between">
                                <div class="text-sici-muted text-sm flex items-center">
                                    <span>📍 {{ $event->location }}</span>
                                </div>
                                <a href="{{ route('events.show', $event) }}" class="bg-sici-red hover:bg-sici-redDark text-white text-sm font-bold px-4 py-2 rounded transition">
                                    Ver Detalles
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-10">
                        <p class="text-gray-400 text-lg">No hay eventos programados por el momento.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

</x-layout>