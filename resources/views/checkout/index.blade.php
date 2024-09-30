<x-app-layout>
    <div class="w-full grid gap-8 md:w-1/2 lg:w-2/3">
        <div class="hidden sm:inline-flex">
            {{ Breadcrumbs::render('checkout') }}
        </div>

        <x-text-heading>
            Finalizar Pedido
        </x-text-heading>

        <x-form action="{{ route('commissions.store') }}">
            <p class="text-lg">
                Fazendo encomenda para a loja
                <x-link href="{{ route('shop.show', $shop->url) }}">
                    {{ $shop->name }}
                </x-link>
            </p>

            <hr>

            @include('checkout.partials.items')

            <hr>

            @include('checkout.partials.payment')

            <hr>

            @include('checkout.partials.shipping')

            <hr>

            <input type="hidden" name="status_id" value="1"/>

            <div class="grid gap-8">
                <x-text-heading class="text-secondary-regular flex justify-between">
                    Total <span>R$ {{ number_format($cart_total, 2, ',', '.') }}</span>
                </x-text-heading>

                <x-button class="w-full"
                                  :disabled="$shippingAddresses->isEmpty() ? true : false">
                    Finalizar Encomenda
                </x-button>
            </div>
        </x-form>
    </div>
</x-app-layout>
