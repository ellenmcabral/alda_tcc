<x-button-outlined :color="'gray'" class="w-full sm:w-fit"
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-commission-deletion')">
    Cancelar Encomenda
</x-button-outlined>

<x-modal :maxWidth="'sm'" name="confirm-commission-deletion"
         :show="$errors->commissionDeletion->isNotEmpty()" focusable>
    <form method="post"
          action="{{ route('commissions.destroy', $commission->id) }}"
          class="grid gap-4 p-6">
        @csrf
        @method('delete')

        <x-text-subheading>
            Cancelar esta encomenda?
        </x-text-subheading>

        <p class="text-gray-dark">
            A encomenda <i class="fa-solid fa-hashtag"></i>{{ $commission->id }} será cancelada permanentemente.
        </p>

        <div>
            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

            <x-input-text
                id="password"
                name="password"
                type="password"
                placeholder="Digite sua senha para confirmar"
            />

            <x-input-error :messages="$errors->commissionDeletion->get('password')" class="mt-2" />
        </div>

        <div class="flex gap-4 justify-end">
            <x-button-outlined class="cursor-pointer" :color="'gray'"
                               x-on:click="$dispatch('close')">
                Manter
            </x-button-outlined>

            <x-button-danger class="uppercase">
                Cancelar
            </x-button-danger>
        </div>
    </form>
</x-modal>
