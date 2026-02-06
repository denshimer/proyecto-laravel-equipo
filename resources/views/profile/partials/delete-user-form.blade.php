<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-white">
            Eliminar Cuenta
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente. Antes de eliminar tu cuenta, descarga cualquier dato o información que desees conservar.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg shadow-red-900/20"
    >Eliminar Cuenta</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-white">
                ¿Estás seguro de que deseas eliminar tu cuenta?
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente. Por favor, ingresa tu contraseña para confirmar que deseas eliminar tu cuenta permanentemente.
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">Contraseña</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-3/4 bg-sici-dark border border-gray-700 text-white rounded-lg px-4 py-2 focus:border-red-500 focus:ring-red-500 transition"
                    placeholder="Contraseña"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" 
                    class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-semibold transition ">
                    Cancelar
                </button>

                <button type="submit" 
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold transition shadow-lg shadow-red-900/20">
                    Eliminar Cuenta
                </button>
            </div>
        </form>
    </x-modal>
</section>
