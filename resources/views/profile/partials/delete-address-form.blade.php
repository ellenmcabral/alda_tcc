<x-button-danger class="cursor-pointer w-fit"
                 x-data=""
                 x-on:click.prevent="$dispatch('open-modal', 'confirm-shipping-address-deletion-{{ $address->id  }}')">
    Excluir
</x-button-danger>

<x-modal-delete name="confirm-shipping-address-deletion-{{ $address->id }}"
                :show="'shippingAddressDeletion'"
                :action="route('profile.shipping-addresses.destroy', $address->id)"
                :password="false">
    <x-slot:heading>
        Excluir este endereço?
    </x-slot:heading>

    <x-slot:description>
        {{ $address->street }}, {{ $address->number }} {{ isset($address->complement) ?? '.' . $address->complement }} - {{ $address->locality }} - {{ $address->city }} / {{ $address->region_code }} - {{ $address->postal_code }}
    </x-slot:description>

    <x-slot:button>

    </x-slot:button>
</x-modal-delete>
