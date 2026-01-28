<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" x-data="{ role: 'student' }">
        @csrf

        <div class="flex gap-4">
            <div class="w-1/2">
                <x-input-label for="first_name" :value="__('Nombres')" />
                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>
            <div class="w-1/2">
                <x-input-label for="last_name" :value="__('Apellidos')" />
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6 border-t border-b py-4 border-gray-200">
            <span class="block font-medium text-sm text-gray-700 mb-2">¿Cómo deseas registrarte?</span>
            <div class="flex gap-6">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="radio" name="role" value="student" x-model="role" class="text-indigo-600 focus:ring-indigo-500 border-gray-300">
                    <span class="ml-2 text-gray-700 font-bold">Estudiante / Externo</span>
                </label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="radio" name="role" value="teacher" x-model="role" class="text-indigo-600 focus:ring-indigo-500 border-gray-300">
                    <span class="ml-2 text-gray-700 font-bold">Docente</span>
                </label>
            </div>
        </div>

        <div x-show="role === 'student'" class="mt-4 space-y-4 bg-gray-50 p-4 rounded-md border border-gray-200">
            <h3 class="text-sm font-bold text-gray-500 uppercase">Datos Académicos</h3>

            <div>
                <x-input-label for="university_code" :value="__('Registro Universitario (RU)')" />
                <x-text-input id="university_code" class="block mt-1 w-full" type="text" name="university_code" :value="old('university_code')" placeholder="Déjalo vacío si eres externo" />
                <x-input-error :messages="$errors->get('university_code')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="semester" :value="__('Semestre Actual')" />
                <select name="semester" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">-- Selecciona --</option>
                    @foreach(range(1, 10) as $i)
                    <option value="{{ $i }}">{{ $i }}° Semestre</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div x-show="role === 'teacher'" class="mt-4 space-y-4 bg-indigo-50 p-4 rounded-md border border-indigo-200" style="display: none;">
            <h3 class="text-sm font-bold text-indigo-500 uppercase">Datos Profesionales</h3>

            <div>
                <x-input-label for="academic_degree" :value="__('Grado Académico')" />
                <select name="academic_degree" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="Ing.">Ingeniero (Ing.)</option>
                    <option value="Lic.">Licenciado (Lic.)</option>
                    <option value="MSc.">Magister (MSc.)</option>
                    <option value="PhD.">Doctor (PhD.)</option>
                </select>
            </div>

            <div>
                <x-input-label for="specialty" :value="__('Especialidad Principal')" />
                <x-text-input id="specialty" class="block mt-1 w-full" type="text" name="specialty" placeholder="Ej: Inteligencia Artificial" />
            </div>

            <div>
                <x-input-label for="phone" :value="__('Celular de Contacto')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('¿Ya estás registrado?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>