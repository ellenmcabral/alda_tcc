<x-app-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('commissions.show', $commission->id) }}
    </x-slot:breadcrumbs>

    <div class="flex flex-col gap-8 w-full h-fit lg:w-2/3">
        <x-text-heading>
            Pedido
            <i class="fa-solid fa-hashtag"></i>
            {{ $commission->id }}
        </x-text-heading>

        <section class="flex justify-between">
            <p class="text-lg">
                Encomenda para a loja
                <x-link href="{{ route('shop.show', $commission->shop->url) }}">
                    {{ $commission->shop->name }}
                </x-link>
            </p>
            <p class="text-gray-dark">
                Feita em {{ date('d/m/Y', strtotime($commission->created_at)) }}
            </p>
        </section>

        <section class="flex justify-between items-center">
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

            <x-button-secondary href="#">
                Realizar Pagamento <i class="fa-solid fa-chevron-right"></i>
            </x-button-secondary>
        </section>

        @include('commissions.partials.items-info')

        @include('commissions.partials.shipping-address-info')

        @include('commissions.partials.payment-info')

        <x-text-heading class="text-secondary-regular flex justify-between">
            Total
            <span>
                    {{ $commission->formatPrice() }}
                </span>
        </x-text-heading>

        @include('commissions.partials.delete-commission')
    </div>
</x-app-layout>
