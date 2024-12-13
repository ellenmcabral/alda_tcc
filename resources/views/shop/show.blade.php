<x-app-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('shop.show', $shop) }}
    </x-slot:breadcrumbs>

    <div class="flex flex-col gap-8 h-fit w-full lg:px-8">
        <section class="flex flex-col lg:flex-row lg:justify-between lg:flex gap-8">
            <div class="flex flex-col lg:flex-row gap-4 items-center">
                <!-- Shop Image -->
                <x-image src="{{ $shop->getImagePath() }}"
                         class="w-48 lg:w-32 self-center rounded-full bg-gray-200"
                         alt="Imagem de perfil da loja {{ $shop->name }}" />
                <div class="grid gap-2">
                    <x-text-heading class="text-center lg:text-left">
                        {{ $shop->name }}
                    </x-text-heading>
                    <p class="text-center lg:text-left text-gray-dark font-bold">
                        {{ $shop->formatUrl() }}
                    </p>
                </div>
            </div>

            <div class="w-full lg:w-fit self-end">
                @php
                    $phone = preg_replace('/\D/', '', $shop->user->phone);
                    $message = 'Olá, encontrei seu contato através da plataforma Alda. Gostaria de fazer uma encomenda personalizada!';
                    $url = 'https://wa.me/' . $phone . '/?text=' . $message;
                @endphp

                <x-button-secondary href="{{ $url }}">
                    Contato <i class="fa-solid fa-phone"></i>
                </x-button-secondary>
            </div>
        </section>

        <section class="grid gap-2">
            <x-text>
                <i class="fa-solid fa-calendar-days text-gray-regular mr-2"></i>Loja criada em {{ date('d/m/Y', strtotime($shop->created_at)) }}
            </x-text>
            @isset($shop->description)
                <x-text class="whitespace-pre-line"><i class="text-gray-regular fa-solid fa-circle-info mr-2"></i>{{ $shop->description }}</x-text>
            @endisset
        </section>

        <hr/>

        <livewire:search :searchType="'Produtos'" :shop="$shop" />
    </div>
</x-app-layout>
