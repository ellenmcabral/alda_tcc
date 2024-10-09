<x-dashboard-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('shop.address.edit') }}
    </x-slot:breadcrumbs>

    <div class="grid gap-8 w-full h-fit md:w-2/3">
        @if($shop->street)
            @include('artisan.shop.address.partials.update-address-form')

        @else
            <div class="hidden sm:inline-flex">
                {{ Breadcrumbs::render('shop.address.create') }}
            </div>

            <x-text-heading>
                Adicionar Endereço
            </x-text-heading>

            <p>
                Digite seu CEP para preencher o restante dos campos de endereço.
            </p>

            <x-form-address :action="route('artisan.shop.address.update')"
                            :address="false" :update="true" />
        @endif
    </div>
</x-dashboard-layout>
