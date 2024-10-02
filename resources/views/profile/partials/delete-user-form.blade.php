<x-button-danger
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
    Excluir Conta
</x-button-danger>

<x-modal :maxWidth="'sm'"
         name="confirm-user-deletion"
         :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form class="grid gap-4 p-6"
          method="post"
          action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')

        <h3 class="text-2xl font-bold text-neutral-black">
            Tem certeza que deseja excluir sua conta?
        </h3>

        <p class="text-gray-dark">
            Todos os seus dados serão perdidos permanentemente.
        </p>

        <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
        <x-input-text
            id="password"
            name="password"
            type="password"
            class="w-full"
            placeholder="Digite sua senha para confirmar" />
        <x-input-error :messages="$errors->userDeletion->get('password')" />

        <div class="flex justify-between mt-4">
            <x-button-outlined :color="'gray'" x-on:click="$dispatch('close')">
                Cancelar
            </x-button-outlined>

            <x-button-danger>
                Sim, excluir conta
            </x-button-danger>
        </div>
    </form>
</x-modal>
