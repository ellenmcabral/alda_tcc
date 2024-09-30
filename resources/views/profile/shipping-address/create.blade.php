<x-app-layout>
    <div class="grid gap-8 w-full lg:w-1/2 xl:w-1/3">
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
