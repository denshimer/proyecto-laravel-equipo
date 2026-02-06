<x-dashboard-layout title="Mi Perfil | SICI-ISI" header="Mi Perfil">
    
    <!-- Botón Atrás -->
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Volver al Dashboard
        </a>
    </div>

    <div class="space-y-6">
        <!-- Información de Perfil -->
        <div class="p-6 bg-sici-card border border-gray-800 shadow-lg rounded-xl">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Actualizar Contraseña -->
        <div class="p-6 bg-sici-card border border-gray-800 shadow-lg rounded-xl">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Eliminar Cuenta -->
        <div class="p-6 bg-sici-card border border-gray-800 shadow-lg rounded-xl">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

</x-dashboard-layout>
