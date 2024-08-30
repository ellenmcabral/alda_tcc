<x-slot name="heading">
    Adicionar Endereço
</x-slot>

<x-slot name="breadcrumbs">
    {{ Breadcrumbs::render('shop.address.create') }}
</x-slot>

<x-form-address :action="route('artisan.shop.address.update')"
                :address="false" :update="true" />
