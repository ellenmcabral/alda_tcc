<x-app-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('commissions.show', $commission->id) }}
    </x-slot:breadcrumbs>

    <div class="flex flex-col gap-10 w-full h-fit lg:w-2/3">
        <x-text-heading>
            Pedido
            <i class="fa-solid fa-hashtag"></i>
            {{ $commission->id }}
        </x-text-heading>

        @if($commission->status->id == 1)
            <x-button-secondary href="#" class="w-fit self-end">
                Realizar Pagamento <i class="fa-solid fa-chevron-right"></i>
            </x-button-secondary>
        @endif

        <section class="flex justify-between items-center flex-wrap gap-4">
            <x-tag-commission :status="$commission->status->id">
                {{ $commission->status->description }}
            </x-tag-commission>

            <p class="text-sm md:text-base">
                Feito em {{ date('d/m/Y', strtotime($commission->created_at)) }}
            </p>
        </section>

        <section class="grid gap-4">
            <x-text-subheading>
                <i class="mr-1 fa-solid fa-store"></i>
                Loja
            </x-text-subheading>
            <div class="flex gap-4 justify-between sm:items-center sm:flex-row flex-col">
                <p>
                    {{ $commission->shop->name }}
                </p>
                <x-link class="self-end" href="{{ route('shop.show', $commission->shop->url) }}">
                    Ver loja <i class="text-sm fa-solid fa-chevron-right"></i>
                </x-link>
            </div>
        </section>

        @include('commissions.partials.items')

        @include('commissions.partials.shipping')

        @include('commissions.partials.payment')

        <x-text-heading class="text-secondary-regular flex justify-between">
            Total
            <span>
                    {{ $commission->formatPrice() }}
                </span>
        </x-text-heading>

        @if($commission->status->id >= 1 and $commission->status->id <= 4)
            @include('commissions.partials.delete-commission')
        @endif

    </div>
</x-app-layout>
