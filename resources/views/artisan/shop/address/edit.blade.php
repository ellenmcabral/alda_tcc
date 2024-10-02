<x-dashboard-layout>
    <div class="w-full h-fit grid gap-8 lg:w-1/2">
        @if($shop->street)
            <div class="hidden sm:inline-flex">
                {{ Breadcrumbs::render('shop.address.edit') }}
            </div>

            <x-text-heading>
                Editar Endereço
            </x-text-heading>

            @include('artisan.shop.address.partials.update-address-form')

        @else
            <div class="hidden sm:inline-flex">
                {{ Breadcrumbs::render('shop.address.create') }}
            </div>

            <x-text-heading>
                Adicionar Endereço
            </x-text-heading>

            <x-form-address :action="route('artisan.shop.address.update')"
                            :address="false" :update="true" />
        @endif
    </div>
</x-dashboard-layout>
