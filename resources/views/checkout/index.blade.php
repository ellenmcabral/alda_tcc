<x-app-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('checkout') }}
    </x-slot:breadcrumbs>

    <div class="w-full grid gap-8 lg:w-2/3">
        <x-text-heading>Finalizar Pedido</x-text-heading>
        <x-form :width="'full'"
                action="{{ route('commissions.store') }}">
            <div class="grid gap-4">
                <header class="flex items-center gap-2">
                    <i class="fa-solid fa-shop"></i>
                    <x-text-subheading>
                        Loja
                    </x-text-subheading>
                </header>
                <x-link href="{{ route('shop.show', $shop->url) }}">
                    {{ $shop->name }}
                </x-link>
            </div>

            @include('checkout.partials.items')

            @include('checkout.partials.payment')

            @include('checkout.partials.shipping')

            <input type="hidden" name="status_id" value="1"/>

            <x-text-heading class="text-secondary-regular flex justify-between">
                Total <span>R$ {{ number_format($cart_total, 2, ',', '.') }}</span>
            </x-text-heading>

            <x-button class="w-full md:self-end md:w-64"
                      :disabled="$shippingAddresses->isEmpty() ? true : false">
                Finalizar pedido
            </x-button>
        </x-form>
    </div>
</x-app-layout>
