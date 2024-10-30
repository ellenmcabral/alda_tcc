<x-dashboard-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('shop.commissions.show', $commission->id) }}
    </x-slot:breadcrumbs>

    <div class="flex flex-col gap-10 w-full h-fit lg:w-2/3">
        <section class="grid gap-4">
            <div class="flex flex-col sm:items-center sm:flex-row sm:justify-between gap-4">
                <x-text-heading>
                    Encomenda
                    <i class="fa-solid fa-hashtag"></i>
                    {{ $commission->id }}
                </x-text-heading>

                <x-tag-commission class="self-end"
                                  :status="$commission->status->id">
                    {{ $commission->status->description }}
                </x-tag-commission>
            </div>
            <div class="grid gap-2">
                <p class="text-gray-dark text-sm md:text-base">
                    Feita em {{ $commission->formatDate() }}
                </p>
                <p class="text-gray-dark text-sm md:text-base">
                    Atualizada em {{ $commission->formatDate('updated_at') }}
                </p>
            </div>
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
                <p>
                    <span class="font-bold">Nome:</span> {{ $commission->user->name }}
                </p>
                <div class="flex items-center gap-4">
                    <p>
                        <span class="font-bold">Telefone:</span> {{ $commission->user->phone }}
                    </p>

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
