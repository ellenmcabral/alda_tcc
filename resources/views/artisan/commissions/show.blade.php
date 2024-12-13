<x-dashboard-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('shop.commissions.show', $commission->id) }}
    </x-slot:breadcrumbs>

    <div class="flex flex-col gap-10 w-full h-fit lg:w-2/3">
        @if($commission->status->id == 6)
            <x-text class="p-4 bg-danger-regular rounded border border-danger-dark">
                Este pedido será removido permanentemente após 1 mês.
            </x-text>
        @endif

        <section class="flex flex-col sm:items-center sm:flex-row sm:justify-between gap-4">
            <x-text-heading>
                Encomenda
                <i class="fa-solid fa-hashtag"></i>
                {{ $commission->id }}
            </x-text-heading>

            <x-tag-commission class="self-end"
                              :status="$commission->status->id">
                {{ $commission->status->description }}
            </x-tag-commission>
        </section>

        <section class="grid gap-2">
            <x-text>
                Feita em {{ $commission->formatDate() }}
            </x-text>
            <x-text>
                Atualizada em {{ $commission->formatDate('updated_at') }}
            </x-text>
        </section>

        <section class="flex justify-end">
            @include('artisan.commissions.partials.update-commission')
        </section>

        <section class="grid gap-4">
            <x-text-subheading>
                <i class="mr-1 fa-solid fa-user"></i>
                Cliente
            </x-text-subheading>
            <div>
                <x-text>
                    <span class="font-bold">Nome:</span> {{ $commission->user->name }}
                </x-text>
                <div class="flex items-center flex-wrap gap-4">
                    <x-text>
                        <span class="font-bold">Telefone:</span> {{ $commission->user->phone }}
                    </x-text>

                    <x-link href="https://wa.me/{{ preg_replace('/\D/', '', $commission->user->phone) }}">
                        Entrar em contato <i class="ml-1 text-sm fa-solid fa-arrow-up-right-from-square"></i>
                    </x-link>
                </div>
            </div>
        </section>

        @include('artisan.commissions.partials.items')

        @include('artisan.commissions.partials.shipping')

        @include('artisan.commissions.partials.payment')

        <x-text-heading class="text-secondary-regular flex justify-between">
            Total
            <span>
                {{ $commission->formatPrice() }}
            </span>
        </x-text-heading>
    </div>
</x-dashboard-layout>
