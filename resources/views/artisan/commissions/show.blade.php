<x-dashboard-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('shop.commissions.show', $commission->id) }}
    </x-slot:breadcrumbs>

    <div class="flex flex-col gap-10 w-full h-fit lg:w-2/3">
        <x-text-heading>
            Encomenda
            <i class="fa-solid fa-hashtag"></i>
            {{ $commission->id }}
        </x-text-heading>

        <section class="flex justify-end">
            @include('artisan.commissions.partials.update-commission')
        </section>

        <section class="flex justify-between items-center gap-4">
            <x-tag-commission :status="$commission->status->id">
                {{ $commission->status->description }}
            </x-tag-commission>

            <p class="text-sm md:text-base">
                Feita em {{ date('d/m/Y', strtotime($commission->created_at)) }}
            </p>
        </section>

        <section class="grid gap-4">
            <x-text-subheading>
                <i class="mr-1 fa-solid fa-user"></i>
                Cliente
            </x-text-subheading>
            <div class="flex gap-4 justify-between sm:items-center sm:flex-row flex-col">
                <p>
                    {{ $commission->user->name }}
                </p>
                <x-link href="https://wa.me/{{ preg_replace('/\D/', '', $commission->user->phone) }}">
                    Entrar em contato <i class="ml-1 text-sm fa-solid fa-arrow-up-right-from-square"></i>
                </x-link>
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
