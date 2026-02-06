<x-dashboard-layout title="Crear Nuevo Usuario | SICI-ISI" header="Crear Nuevo Usuario">
    
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Volver a Usuarios
        </a>
    </div>

    <div class="bg-sici-card border border-gray-800 overflow-hidden shadow-lg rounded-xl p-6">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <!-- Nombre -->
            <div class="mb-4">
                <label for="first_name" class="block text-sm font-medium text-gray-400">Nombre</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                @error('first_name')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Apellido -->
            <div class="mb-4">
                <label for="last_name" class="block text-sm font-medium text-gray-400">Apellido</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                @error('last_name')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-400">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                @error('email')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-400">Contraseña</label>
                <input type="password" name="password" id="password" required
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                @error('password')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-400">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
            </div>

            <!-- Rol -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-400">Rol</label>
                <select name="role" id="role" required
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                    <option value="">Seleccionar rol...</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ old('role') === $role->name ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                    @endforeach
                </select>
                @error('role')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tipo de Perfil -->
            <div class="mb-4">
                <label for="profile_type" class="block text-sm font-medium text-gray-400">Tipo de Perfil</label>
                <select name="profile_type" id="profile_type" required
                    class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                    <option value="student" {{ old('profile_type') === 'student' ? 'selected' : '' }}>Estudiante</option>
                    <option value="teacher" {{ old('profile_type') === 'teacher' ? 'selected' : '' }}>Docente</option>
                </select>
                @error('profile_type')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campos de Estudiante (condicionales) -->
            <div id="student-fields" class="hidden p-4 bg-blue-500/10 border border-blue-500/30 rounded-lg mb-4">
                <h4 class="text-sm font-semibold text-blue-400 mb-3">Datos de Estudiante</h4>
                <div class="mb-4">
                    <label for="university_code" class="block text-sm font-medium text-gray-400">Código Universitario (RU)</label>
                    <input type="text" name="university_code" id="university_code" value="{{ old('university_code') }}"
                        class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                </div>
                <div class="mb-4">
                    <label for="semester" class="block text-sm font-medium text-gray-400">Semestre</label>
                    <input type="number" name="semester" id="semester" value="{{ old('semester') }}"
                        class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                </div>
            </div>

            <!-- Campos de Docente (condicionales) -->
            <div id="teacher-fields" class="hidden p-4 bg-green-500/10 border border-green-500/30 rounded-lg mb-4">
                <h4 class="text-sm font-semibold text-green-400 mb-3">Datos de Docente</h4>
                <div class="mb-4">
                    <label for="academic_degree" class="block text-sm font-medium text-gray-400">Grado Académico</label>
                    <input type="text" name="academic_degree" id="academic_degree" value="{{ old('academic_degree') }}"
                        class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                </div>
                <div class="mb-4">
                    <label for="specialty" class="block text-sm font-medium text-gray-400">Especialidad</label>
                    <input type="text" name="specialty" id="specialty" value="{{ old('specialty') }}"
                        class="mt-1 block w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition">
                </div>
            </div>

            <!-- Botones -->
            <div class="flex gap-4">
                <button type="submit" class="bg-sici-red hover:bg-sici-redDark text-white px-6 py-3 rounded-lg transition font-semibold shadow-lg shadow-red-900/20">
                    Crear Usuario
                </button>
                <a href="{{ route('admin.users.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition font-semibold">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('profile_type').addEventListener('change', function() {
            const studentFields = document.getElementById('student-fields');
            const teacherFields = document.getElementById('teacher-fields');
            
            if (this.value === 'student') {
                studentFields.classList.remove('hidden');
                teacherFields.classList.add('hidden');
            } else {
                studentFields.classList.add('hidden');
                teacherFields.classList.remove('hidden');
            }
        });
        
        // Trigger on load if old value exists
        document.getElementById('profile_type').dispatchEvent(new Event('change'));
    </script>

</x-dashboard-layout>
