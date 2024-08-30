<x-app-layout>
    <x-slot name="breadcrumbs">
        {{ Breadcrumbs::render('checkout') }}
    </x-slot>
    <x-slot name="heading">
        Finalizar Encomenda
    </x-slot>
    <form class="grid gap-10" method="post" action="{{ route('commissions.store') }}">
        @csrf

        @include('checkout.partials.items')

        @include('checkout.partials.payment')

        @include('checkout.partials.shipping')

        <input type="hidden" name="status_id" value="1"/>

        <div>
            <h2 class="mb-4 flex justify-between font-bold text-2xl text-primary-700">
            <span>
                Total:
            </span>
                R$ {{ number_format($cart_total, 2, ',', '.') }}
            </h2>

            <x-primary-button class="w-full"
                              :disabled="$shippingAddresses->isEmpty() ? true : false">
                Finalizar Encomenda
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
