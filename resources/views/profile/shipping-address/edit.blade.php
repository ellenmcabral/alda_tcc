<x-app-layout>
    <div class="grid gap-8 w-full lg:w-1/2 xl:w-1/3">
        <div class="hidden sm:inline-flex">
            {{ Breadcrumbs::render('shipping-address.edit', $address) }}
        </div>

        <x-text-heading>
            Atualizar Endereço
        </x-text-heading>

        <x-form-address :action="route('shipping-address.update', $address->id)"
                        :address="$address" :update="true" :checkbox="true" />

        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-shipping-address-deletion')">
            Deletar Endereço
        </x-danger-button>

        <x-modal name="confirm-shipping-address-deletion"
                 :show="$errors->shippingAddressDeletion->isNotEmpty()" focusable>
            <form class="p-8" method="post" action="{{ route('shipping-address.destroy', $address->id) }}">
                @csrf
                @method('delete')

                <h2 class="text-2xl font-extrabold">
                    Deseja deletar este endereço?
                </h2>

                <div class="mt-6 flex justify-between">
                    <button class="uppercase text-xs border border-gray-400 px-4 rounded-lg font-extrabold text-gray-400" x-on:click="$dispatch('close')">
                        Não, cancelar
                    </button>

                    <x-danger-button>
                        Sim, deletar
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
