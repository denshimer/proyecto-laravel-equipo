<x-layout title="Nosotros | SICI-ISI">
    
    <section class="min-h-[80vh] flex items-center bg-sici-dark py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8 font-display">
                        ¿Qué es SICI-ISI?
                    </h2>
                    
                    <div class="text-gray-300 space-y-4 leading-relaxed text-lg text-justify font-sans">
                        <p>
                            La Sociedad de Investigación, Ciencia e Innovación (SICI) de la carrera de 
                            Ingeniería de Sistemas Informáticos es un espacio dedicado a potenciar el 
                            talento tecnológico de nuestros estudiantes.
                        </p>
                        <p>
                            Nuestra misión es fomentar el desarrollo de habilidades prácticas a través de 
                            proyectos reales, hackathons y talleres colaborativos. Creemos que la teoría 
                            se fortalece cuando se aplica en la resolución de problemas tangibles.
                        </p>
                        <p>
                            Buscamos crear una comunidad donde el aprendizaje continuo, el trabajo en equipo 
                            y la pasión por el código sean los pilares fundamentales para formar a los 
                            profesionales del mañana.
                        </p>
                    </div>
                </div>

                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-sici-red to-purple-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                    
                    <div class="relative">
                        <img 
                            src="{{ asset('images/code-bg.jpg') }}" 
                            alt="Código SICI-ISI" 
                            class="rounded-lg border border-sici-red shadow-2xl w-full object-cover transform transition duration-500 hover:scale-[1.01]"
                        >
                        
                        <div class="absolute top-4 left-4 flex space-x-2">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

</x-layout>