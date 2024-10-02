<x-app-layout>
    <div class="w-full h-fit grid gap-8 lg:w-1/2">
        <div class="hidden sm:inline-flex">
            {{ Breadcrumbs::render('shipping-address.create') }}
        </div>

        <x-text-heading>
            Adicionar Endereço
        </x-text-heading>

        <x-form-address :action="route('shipping-address.store')"
                        :address="false" />
    </div>
</x-app-layout>
