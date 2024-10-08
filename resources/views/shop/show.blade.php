<x-app-layout>
    <div class="flex flex-col gap-8 h-fit w-full lg:px-8">
        <div class="hidden sm:inline-flex">
            {{ Breadcrumbs::render('shop.show', $shop) }}
        </div>

        <section class="flex flex-col gap-8">
            <div class="w-full h-fit flex flex-col lg:flex-row gap-4 items-center">
                <div class="w-48 lg:w-32 self-center aspect-square rounded-full bg-gray-200">
                    <!-- Shop Image -->
                </div>
                <div class="w-full flex flex-col lg:items-start items-center gap-2">
                    <x-text-heading class="text-center lg:text-left">
                        {{ $shop->name }}
                    </x-text-heading>
                    <p class="text-gray-dark font-bold">
                        {{ $shop->formatUrl() }}
                    </p>
                </div>
            </div>

            <div class="w-full lg:w-1/2 xl:w-1/3 flex h-fit gap-4 self-end">
                <x-button-outlined href="" :color="'gray'"
                                   class="w-1/2 normal-case">
                    Compartilhar <i class="ml-1 fa-solid fa-share"></i>
                </x-button-outlined>
                @php
                    $phone = preg_replace('/\D/', '', $shop->user->phone);
                    $message = 'Olá, encontrei seu contato através da plataforma Alda. Gostaria de fazer uma encomenda personalizada!';
                    $url = 'https://wa.me/' . $phone . '/?text=' . $message;
                @endphp

                <x-button-secondary class="w-1/2 text-center" href="{{ $url }}">
                    Contato <i class="fa-solid fa-phone"></i>
                </x-button-secondary>
            </div>
        </section>

        <section class="grid gap-2">
            <p>
                <i class="fa-solid fa-calendar-days text-gray-regular mr-2"></i> Loja criada em {{ date('d/m/Y', strtotime($shop->created_at)) }}
            </p>
            @isset($shop->description)
                <p class="whitespace-pre-line"><i class="text-gray-regular fa-solid fa-circle-info mr-2"></i> {{ $shop->description }}</p>
            @endisset
        </section>

        <hr/>

        <livewire:live-search :searchType="'Produtos'" :shop="$shop" />
    </div>
</x-app-layout>
