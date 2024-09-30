<x-app-layout>
    <div class="grid gap-8 w-full h-fit lg:w-1/2 xl:w-1/3">
        <div class="hidden sm:inline-flex">
            {{ Breadcrumbs::render('commissions.show', $commission->id) }}
        </div>

        <x-text-heading>
            Pedido
            <i class="fa-solid fa-hashtag"></i>
            {{ $commission->id }}
        </x-text-heading>

        <p class="text-lg">
            Encomenda para a loja
            <x-link href="{{ route('shop.show', $commission->shop->url) }}">
                {{ $commission->shop->name }}
            </x-link>
        </p>

        <section class="flex justify-between">
            <div class="flex items-center gap-2">
                <div class="rounded-full h-3 w-3 @if($commission->status->id >= 1 and $commission->status->id < 4)
                                                  bg-warning-regular
                                                  @elseif($commission->status->id == 5)
                                                  bg-success-regular
                                                  @else
                                                  bg-danger-regular
                                                  @endif "></div>
                <p class="@if($commission->status->id >= 1 and $commission->status->id < 4)
                                                  text-yellow-600
                                                  @elseif($commission->status->id == 5)
                                                  text-green-600
                                                  @else
                                                  text-red-600
                                                  @endif ">
                    {{ $commission->status->description }}
                </p>
            </div>
            <p class="text-gray-dark">
                Feita em {{ date('d/m/Y', strtotime($commission->created_at)) }}
            </p>
        </section>

        <hr/>

        @include('commissions.partials.items-info')

        <hr/>

        @include('commissions.partials.shipping-address-info')

        <hr/>

        @include('commissions.partials.payment-info')

        <hr/>

        <x-text-heading class="text-secondary-regular flex justify-between">
            Total
            <span>
                    {{ $commission->formatPrice() }}
                </span>
        </x-text-heading>

        <div class="flex justify-between gap-4">
            @include('commissions.partials.delete-commission')

            <x-button class="w-1/2">
                Realizar Pagamento
            </x-button>
        </div>
    </div>
</x-app-layout>
