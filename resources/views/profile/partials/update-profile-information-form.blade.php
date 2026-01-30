<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Información de Perfil
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Actualiza tu información personal y profesional.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Información Básica -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="first_name" value="Nombre" />
                <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
            </div>

            <div>
                <x-input-label for="last_name" value="Apellido" />
                <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required />
                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
            </div>
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        Tu correo no está verificado.

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            Reenviar correo de verificación
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            Se envió un nuevo enlace de verificación a tu correo.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- CAMPOS ESPECÍFICOS PARA ESTUDIANTES -->
        @if($user->profile_type === 'student' && $user->student)
            <div class="pt-4 border-t border-gray-200">
                <h3 class="text-md font-semibold text-gray-900 mb-4">Información Académica</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="university_code" value="Código Universitario (RU)" />
                        <x-text-input id="university_code" name="university_code" type="text" class="mt-1 block w-full" :value="old('university_code', $user->student->university_code)" />
                        <x-input-error class="mt-2" :messages="$errors->get('university_code')" />
                    </div>

                    <div>
                        <x-input-label for="semester" value="Semestre" />
                        <select id="semester" name="semester" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">Selecciona tu semestre</option>
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ old('semester', $user->student->semester) == $i ? 'selected' : '' }}>{{ $i }}° Semestre</option>
                            @endfor
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('semester')" />
                    </div>

                    <div>
                        <x-input-label for="phone" value="Teléfono" />
                        <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $user->student->phone)" />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>

                    <div>
                        <x-input-label for="birthdate" value="Fecha de Nacimiento" />
                        <x-text-input id="birthdate" name="birthdate" type="date" class="mt-1 block w-full" :value="old('birthdate', $user->student->birthdate)" />
                        <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
                    </div>
                </div>
            </div>
        @endif

        <!-- CAMPOS ESPECÍFICOS PARA DOCENTES -->
        @if($user->profile_type === 'teacher' && $user->teacher)
            <div class="pt-4 border-t border-gray-200">
                <h3 class="text-md font-semibold text-gray-900 mb-4">Información Profesional</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="academic_degree" value="Grado Académico" />
                        <select id="academic_degree" name="academic_degree" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="Ing." {{ old('academic_degree', $user->teacher->academic_degree) === 'Ing.' ? 'selected' : '' }}>Ingeniero/a</option>
                            <option value="Lic." {{ old('academic_degree', $user->teacher->academic_degree) === 'Lic.' ? 'selected' : '' }}>Licenciado/a</option>
                            <option value="MSc." {{ old('academic_degree', $user->teacher->academic_degree) === 'MSc.' ? 'selected' : '' }}>Máster</option>
                            <option value="PhD." {{ old('academic_degree', $user->teacher->academic_degree) === 'PhD.' ? 'selected' : '' }}>Doctor/a</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('academic_degree')" />
                    </div>

                    <div>
                        <x-input-label for="specialty" value="Especialidad" />
                        <x-text-input id="specialty" name="specialty" type="text" class="mt-1 block w-full" :value="old('specialty', $user->teacher->specialty)" placeholder="Ej: Inteligencia Artificial, Redes" />
                        <x-input-error class="mt-2" :messages="$errors->get('specialty')" />
                    </div>

                    <div>
                        <x-input-label for="phone" value="Teléfono" />
                        <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $user->teacher->phone)" />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>

                    <div>
                        <x-input-label for="website_url" value="sitio Web / LinkedIn" />
                        <x-text-input id="website_url" name="website_url" type="url" class="mt-1 block w-full" :value="old('website_url', $user->teacher->website_url)" placeholder="https://..." />
                        <x-input-error class="mt-2" :messages="$errors->get('website_url')" />
                    </div>
                </div>

                <div class="mt-4">
                    <x-input-label for="bio" value="Biografía / Presentación" />
                    <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Describe brevemente tu experiencia y áreas de investigación...">{{ old('bio', $user->teacher->bio) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                </div>
            </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>Guardar Cambios</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >Guardado.</p>
            @endif
        </div>
    </form>
</section>

