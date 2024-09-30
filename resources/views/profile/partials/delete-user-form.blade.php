<x-button-danger
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
    Excluir Conta
</x-button-danger>

<x-modal :maxWidth="'sm'" name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form class="grid gap-4 p-6"
          method="post"
          action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')

        <h2 class="text-2xl font-bold text-neutral-black">
            Tem certeza que deseja excluir sua conta?
        </h2>

        <p class="text-gray-dark">
            Ao excluir sua conta, todos os seus dados serão perdidos permanentemente.
        </p>

        <div>
            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
            <x-input-text
                id="password"
                name="password"
                type="password"
                class="w-full"
                placeholder="Digite sua senha para confirmar" />
            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-between gap-8">
            <button class="w-full uppercase text-gray-dark border-2 px-4 py-2 rounded-lg border-gray-regular" x-on:click="$dispatch('close')">
                Cancelar
            </button>

            <x-button-danger class="w-full">
                Sim, excluir conta
            </x-button-danger>
        </div>
    </form>
</x-modal>
