<x-app-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('shipping-addresses.edit', $address->id) }}
    </x-slot:breadcrumbs>

    <div class="w-full h-fit grid gap-8 md:w-2/3">
        <x-form action="{{ route('profile.shipping-addresses.update', $address->id) }}">
            @method('patch')

            <livewire:inputs-address :address="$address" />

            <div class="flex items-center gap-2">
                <input id="is_default"
                       name="is_default"
                       type="checkbox"
                       class="cursor-pointer rounded focus:ring-accent-regular checked:focus:bg-accent-dark checked:bg-accent-dark"
                       value="1" {{ $address->is_default ? 'checked' : '' }} />
                <x-input-label for="is_default"
                               :value="'Este é meu endereço padrão'" />
            </div>

            <x-slot:button>
                Salvar
            </x-slot:button>
        </x-form>
    </div>
</x-app-layout>
