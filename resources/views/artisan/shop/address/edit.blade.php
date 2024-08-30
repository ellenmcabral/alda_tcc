<x-dashboard-layout>
    @if($shop->street)
        @include('artisan.shop.address.partials.update-address-form')

        @include('artisan.shop.address.partials.delete-address-form')
    @else
        @include('artisan.shop.address.partials.create-address-form')
    @endif
</x-dashboard-layout>
