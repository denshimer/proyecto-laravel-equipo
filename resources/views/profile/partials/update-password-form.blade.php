<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            Actualizar Contraseña
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            Asegúrate de usar una contraseña segura y larga para proteger tu cuenta.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-400 mb-2">Contraseña Actual</label>
            <input id="update_password_current_password" name="current_password" type="password" 
                class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition" 
                autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-400 mb-2">Nueva Contraseña</label>
            <input id="update_password_password" name="password" type="password" 
                class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition" 
                autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-400 mb-2">Confirmar Contraseña</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                class="w-full bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-sici-red focus:ring-sici-red transition" 
                autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" 
                class="bg-sici-red hover:bg-sici-redDark text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg shadow-red-900/20">
                Guardar
            </button>

            @if (session('status') === 'password-updated')
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
