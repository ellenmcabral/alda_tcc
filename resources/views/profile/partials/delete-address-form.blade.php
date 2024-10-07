<x-link-secondary class="cursor-pointer w-fit"
                 x-data=""
                 x-on:click.prevent="$dispatch('open-modal', 'confirm-shipping-address-deletion-{{ $address->id  }}')">
    Excluir
</x-link-secondary>

<x-modal :maxWidth="'sm'"
         name="confirm-shipping-address-deletion-{{ $address->id  }}"
         :show="$errors->shippingAddressDeletion->isNotEmpty()" focusable>
    <form method="post"
          action="{{ route('shipping-address.destroy', $address->id) }}">
        @csrf
        @method('delete')

        <div class="grid gap-4 p-6">
            <h3 class="text-2xl font-bold text-neutral-black">
                Tem certeza que deseja excluir este endereço?
            </h3>

            <p>
                {{ $address->street }}, {{ $address->number }} {{ isset($address->complement) ?? '.' . $address->complement }} - {{ $address->locality }} - {{ $address->city }} / {{ $address->region_code }} - {{ $address->postal_code }}
            </p>

            <div class="flex justify-between">
                <x-button-outlined :color="'gray'" x-on:click="$dispatch('close')">
                    Cancelar
                </x-button-outlined>

                <x-button-danger>
                    Sim, excluir
                </x-button-danger>
            </div>
        </div>

    </form>
</x-modal>
