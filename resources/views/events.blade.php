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

                <article class="bg-sici-card rounded-xl overflow-hidden border border-gray-800 hover:border-sici-red transition duration-300 group shadow-lg flex flex-col h-full">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ asset('images/card.jpeg') }}" alt="Evento" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        
                        <div class="absolute top-4 right-4 bg-sici-dark/90 backdrop-blur-sm border border-sici-red rounded-lg p-2 text-center min-w-[70px] shadow-xl">
                            <span class="block text-2xl font-bold text-white font-display">15</span>
                            <span class="block text-xs font-bold text-sici-red uppercase tracking-wider">MAR</span>
                        </div>
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <div class="mb-3">
                            <span class="text-xs font-bold text-blue-400 bg-blue-400/10 px-2 py-1 rounded">Taller Técnico</span>
                        </div>

                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-sici-red transition">
                            Introducción a Docker y Contenedores
                        </h3>
                        
                        <p class="text-gray-400 text-sm mb-6 flex-grow">
                            Aprende a contenerizar tus aplicaciones desde cero. Requisito: Traer laptop con Linux o WSL2 instalado.
                        </p>

                        <div class="border-t border-gray-700 pt-4 flex items-center justify-between">
                            <div class="text-sici-muted text-sm flex items-center">
                                <span>📍 Lab. 3, Bloque C</span>
                            </div>
                            <button class="bg-sici-red hover:bg-sici-redDark text-white text-sm font-bold px-4 py-2 rounded transition">
                                Inscribirme
                            </button>
                        </div>
                    </div>
                </article>

                <article class="bg-sici-card rounded-xl overflow-hidden border border-gray-800 hover:border-sici-red transition duration-300 group shadow-lg flex flex-col h-full">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ asset('images/card.jpeg') }}" alt="Evento" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute top-4 right-4 bg-sici-dark/90 backdrop-blur-sm border border-sici-red rounded-lg p-2 text-center min-w-[70px] shadow-xl">
                            <span class="block text-2xl font-bold text-white font-display">22</span>
                            <span class="block text-xs font-bold text-sici-red uppercase tracking-wider">ABR</span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="mb-3">
                            <span class="text-xs font-bold text-purple-400 bg-purple-400/10 px-2 py-1 rounded">Conferencia</span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-sici-red transition">
                            IA Generativa en el Desarrollo de Software
                        </h3>
                        <p class="text-gray-400 text-sm mb-6 flex-grow">
                            Descubre cómo herramientas como Copilot y ChatGPT están cambiando el flujo de trabajo del desarrollador.
                        </p>
                        <div class="border-t border-gray-700 pt-4 flex items-center justify-between">
                            <div class="text-sici-muted text-sm flex items-center">
                                <span>📍 Auditorio Principal</span>
                            </div>
                            <button class="bg-sici-red hover:bg-sici-redDark text-white text-sm font-bold px-4 py-2 rounded transition">
                                Inscribirme
                            </button>
                        </div>
                    </div>
                </article>

                <article class="bg-sici-card rounded-xl overflow-hidden border border-gray-800 hover:border-sici-red transition duration-300 group shadow-lg flex flex-col h-full">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ asset('images/card.jpeg') }}" alt="Evento" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute top-4 right-4 bg-sici-dark/90 backdrop-blur-sm border border-sici-red rounded-lg p-2 text-center min-w-[70px] shadow-xl">
                            <span class="block text-2xl font-bold text-white font-display">05</span>
                            <span class="block text-xs font-bold text-sici-red uppercase tracking-wider">MAY</span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="mb-3">
                            <span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-1 rounded">Competencia</span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-sici-red transition">
                            ISI Challenge: Hackathon 2026
                        </h3>
                        <p class="text-gray-400 text-sm mb-6 flex-grow">
                            Forma tu equipo y resuelve un problema real en 48 horas. Premios en efectivo y certificaciones.
                        </p>
                        <div class="border-t border-gray-700 pt-4 flex items-center justify-between">
                            <div class="text-sici-muted text-sm flex items-center">
                                <span>📍 Campus Univalle</span>
                            </div>
                            <button class="bg-sici-red hover:bg-sici-redDark text-white text-sm font-bold px-4 py-2 rounded transition">
                                Inscribirme
                            </button>
                        </div>
                    </div>
                </article>

            </div>
        </div>
    </section>

</x-layout>