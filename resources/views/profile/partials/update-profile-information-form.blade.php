<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            Información de Perfil
        </h2>

        <p class="mt-1 text-sm text-gray-400">
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
                <label for="first_name" class="block text-sm font-medium text-gray-400 mb-2">Nombre</label>
                <input id="first_name" name="first_name" type="text" 
                    class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition" 
                    value="{{ old('first_name', $user->first_name) }}" required autofocus>
                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
            </div>

            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-400 mb-2">Apellido</label>
                <input id="last_name" name="last_name" type="text" 
                    class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition" 
                    value="{{ old('last_name', $user->last_name) }}" required>
                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
            </div>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-400 mb-2">Email</label>
            <input id="email" name="email" type="email" 
                class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition" 
                value="{{ old('email', $user->email) }}" required autocomplete="username">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-yellow-400">
                        Tu correo no está verificado.

                        <button form="send-verification" class="underline text-sm text-yellow-500 hover:text-yellow-400 rounded-md transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            Reenviar correo de verificación
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            Se envió un nuevo enlace de verificación a tu correo.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- CAMPOS ESPECÍFICOS PARA ESTUDIANTES -->
        @if($user->profile_type === 'student' && $user->student)
            <div class="pt-4 border-t border-gray-700">
                <h3 class="text-md font-semibold text-white mb-4">Información Académica</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="university_code" class="block text-sm font-medium text-gray-400 mb-2">Código Universitario (RU)</label>
                        <input id="university_code" name="university_code" type="text" 
                            class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition" 
                            value="{{ old('university_code', $user->student->university_code) }}">
                        <x-input-error class="mt-2" :messages="$errors->get('university_code')" />
                    </div>

                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-400 mb-2">Semestre</label>
                        <select id="semester" name="semester" 
                            class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                            <option value="">Selecciona tu semestre</option>
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ old('semester', $user->student->semester) == $i ? 'selected' : '' }}>{{ $i }}° Semestre</option>
                            @endfor
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('semester')" />
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-400 mb-2">Teléfono</label>
                        <input id="phone" name="phone" type="tel" 
                            class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition" 
                            value="{{ old('phone', $user->student->phone) }}">
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>

                    <div>
                        <label for="birthdate" class="block text-sm font-medium text-gray-400 mb-2">Fecha de Nacimiento</label>
                        <input id="birthdate" name="birthdate" type="date" 
                            class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition" 
                            value="{{ old('birthdate', $user->student->birthdate) }}">
                        <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
                    </div>
                </div>
            </div>
        @endif

        <!-- CAMPOS ESPECÍFICOS PARA DOCENTES -->
        @if($user->profile_type === 'teacher' && $user->teacher)
            <div class="pt-4 border-t border-gray-700">
                <h3 class="text-md font-semibold text-white mb-4">Información Profesional</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="academic_degree" class="block text-sm font-medium text-gray-400 mb-2">Grado Académico</label>
                        <select id="academic_degree" name="academic_degree" 
                            class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                            <option value="Ing." {{ old('academic_degree', $user->teacher->academic_degree) === 'Ing.' ? 'selected' : '' }}>Ingeniero/a</option>
                            <option value="Lic." {{ old('academic_degree', $user->teacher->academic_degree) === 'Lic.' ? 'selected' : '' }}>Licenciado/a</option>
                            <option value="MSc." {{ old('academic_degree', $user->teacher->academic_degree) === 'MSc.' ? 'selected' : '' }}>Máster</option>
                            <option value="PhD." {{ old('academic_degree', $user->teacher->academic_degree) === 'PhD.' ? 'selected' : '' }}>Doctor/a</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('academic_degree')" />
                    </div>

                    <div>
                        <label for="specialty" class="block text-sm font-medium text-gray-400 mb-2">Especialidad</label>
                        <input id="specialty" name="specialty" type="text" 
                            class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition" 
                            value="{{ old('specialty', $user->teacher->specialty) }}" 
                            placeholder="Ej: Inteligencia Artificial, Redes">
                        <x-input-error class="mt-2" :messages="$errors->get('specialty')" />
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-400 mb-2">Teléfono</label>
                        <input id="phone" name="phone" type="tel" 
                            class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition" 
                            value="{{ old('phone', $user->teacher->phone) }}">
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>

                    <div>
                        <label for="website_url" class="block text-sm font-medium text-gray-400 mb-2">Sitio Web / LinkedIn</label>
                        <input id="website_url" name="website_url" type="url" 
                            class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition" 
                            value="{{ old('website_url', $user->teacher->website_url) }}" 
                            placeholder="https://...">
                        <x-input-error class="mt-2" :messages="$errors->get('website_url')" />
                    </div>
                </div>

                <div class="mt-4">
                    <label for="bio" class="block text-sm font-medium text-gray-400 mb-2">Biografía / Presentación</label>
                    <textarea id="bio" name="bio" rows="4" 
                        class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition" 
                        placeholder="Describe brevemente tu experiencia y áreas de investigación...">{{ old('bio', $user->teacher->bio) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                </div>
            </div>
        @endif

        <div class="flex items-center gap-4">
            <button type="submit" 
                class="bg-sici-red hover:bg-sici-redDark text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg shadow-red-900/20">
                Guardar Cambios
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400"
                >Guardado.</p>
            @endif
        </div>
    </form>
</section>
