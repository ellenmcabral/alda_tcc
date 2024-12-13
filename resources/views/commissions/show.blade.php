<x-app-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('commissions.show', $commission->id) }}
    </x-slot:breadcrumbs>

    <div class="flex flex-col gap-10 w-full h-fit lg:w-2/3">
        @if($commission->status->id == 6)
            <x-text class="p-4 bg-danger-regular rounded border border-danger-dark">
                Este pedido será removido permanentemente após 1 mês.
            </x-text>
        @endif

        <section class="flex flex-col sm:items-center sm:flex-row sm:justify-between gap-4">
            <x-text-heading>
                Pedido
                <i class="fa-solid fa-hashtag"></i>
                {{ $commission->id }}
            </x-text-heading>

            <x-tag-commission class="self-end"
                              :status="$commission->status->id">
                {{ $commission->status->description }}
            </x-tag-commission>
        </section>

        <section class="grid gap-2 text-sm md:text-base">
            <x-text>
                Feito em {{ $commission->formatDate() }}
            </x-text>
            <x-text>
                Atualizado em {{ $commission->formatDate('updated_at') }}
            </x-text>
        </section>

        @if($commission->status->id == 1)
            <x-button-secondary href="#" class="w-full sm:w-fit self-end">
                Realizar Pagamento <i class="fa-solid fa-chevron-right"></i>
            </x-button-secondary>
        @endif

        <section class="grid flex-col sm:items-center sm:flex-row sm:justify-between gap-4">
            <x-text-subheading>
                <i class="mr-1 fa-solid fa-store"></i>
                Loja
            </x-text-subheading>
            <x-link href="{{ route('shop.show', $commission->shop->url) }}">
                {{ $commission->shop->name }}
            </x-link>
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
