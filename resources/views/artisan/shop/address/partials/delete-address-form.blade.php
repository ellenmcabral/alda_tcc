<x-danger-button class="w-full mt-8"
                 x-data=""
                 x-on:click.prevent="$dispatch('open-modal', 'confirm-shop-address-deletion')"
>{{ __('Remove') }} Endereço</x-danger-button>

<x-modal name="confirm-shop-address-deletion"
         :show="$errors->shopAddressDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('artisan.shop.address.remove') }}" class="p-6">
        @csrf
        @method('patch')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Tem certeza que deseja deletar este endereço?
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Este endereço será excluído permanentemente.
        </p>

        <div class="mt-6">
            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

            <x-text-input
                id="password"
                name="password"
                type="password"
                class="mt-1 block w-3/4"
                placeholder="{{ __('Password') }}"
            />

            <x-input-error :messages="$errors->shopAddressDeletion->get('password')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
