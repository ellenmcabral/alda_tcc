<x-app-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('checkout') }}
    </x-slot:breadcrumbs>

    <div class="w-full grid gap-8 lg:w-2/3">
        <x-form :width="'full'" action="{{ route('commissions.store') }}">
            <p class="text-lg">
                Fazendo encomenda para a loja
                <x-link href="{{ route('shop.show', $shop->url) }}">
                    {{ $shop->name }}
                </x-link>
            </p>

            @include('checkout.partials.items')

            @include('checkout.partials.payment')

            @include('checkout.partials.shipping')

            <input type="hidden" name="status_id" value="1"/>

            <div class="flex flex-col gap-8">
                <x-text-heading class="text-secondary-regular flex justify-between">
                    Total <span>R$ {{ number_format($cart_total, 2, ',', '.') }}</span>
                </x-text-heading>

                <x-button class="w-full md:self-end md:w-64"
                          :disabled="$shippingAddresses->isEmpty() ? true : false">
                    Finalizar Encomenda
                </x-button>
            </div>
        </x-form>
    </div>
</x-app-layout>
