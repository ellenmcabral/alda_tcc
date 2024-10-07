<x-button-danger class="w-fit"
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-commission-deletion')">
    Cancelar Encomenda
</x-button-danger>

<x-modal :maxWidth="'sm'" name="confirm-commission-deletion"
         :show="$errors->commissionDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('commissions.destroy', $commission->id) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Cancelar essa encomenda?
        </h2>

        <div>
            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

            <x-input-text
                id="password"
                name="password"
                type="password"
                class="mt-1 block w-3/4"
                placeholder="Digite sua senha para confirmar"
            />

            <x-input-error :messages="$errors->commissionDeletion->get('password')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-button-outlined class="cursor-pointer" :color="'gray'"
                               x-on:click="$dispatch('close')">
                Manter
            </x-button-outlined>

            <x-button-danger class="ms-3">
                Cancelar
            </x-button-danger>
        </div>
    </form>
</x-modal>
