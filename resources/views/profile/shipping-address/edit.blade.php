<x-app-layout>
    <div class="w-full h-fit grid gap-8 md:w-2/3">
        <div class="hidden sm:inline-flex">
            {{ Breadcrumbs::render('shipping-address.edit', $address) }}
        </div>

        <x-text-heading>
            Editar Endereço
        </x-text-heading>

        <x-form action="{{ route('shipping-address.update', $address->id) }}">
            @method('patch')

            <livewire:inputs-address :address="$address" />

            <div class="flex items-center">
                <input type="checkbox"
                       id="is_default"
                       name="is_default"
                       value="1"
                    {{ $address->is_default ? 'checked' : '' }} >
                <x-input-label for="is_default"
                               class="ml-2"
                               :value="'Este é meu endereço padrão'" />
            </div>

            <x-slot:button>
                Salvar
            </x-slot:button>
        </x-form>
    </div>
</x-app-layout>
