<x-app-layout>
    <div class="flex flex-col gap-8 w-full h-fit md:w-2/3">
        <section class="grid gap-4 xl:flex">
            <div class="w-full h-fit flex gap-4 items-center">
                <div class="p-8 rounded-full bg-gray-200">
                    <!-- Shop Image -->
                </div>
                <div class="w-full grid gap-2">
                    <x-text-heading>
                        {{ $shop->name }}
                    </x-text-heading>
                    <p class="text-gray-dark font-bold">
                        {{ $shop->formatUrl() }}
                    </p>
                </div>
            </div>

            <div class="w-full flex h-fit justify-between gap-4">
                <x-button-outlined href="" :color="'gray'" class="w-1/2 normal-case">
                    Compartilhar <i class="ml-1 fa-solid fa-share"></i>
                </x-button-outlined>
                @php
                    $phone = preg_replace('/\D/', '', $shop->user->phone);
                    $message = 'Olá, encontrei seu contato através da plataforma Alda. Gostaria de fazer uma encomenda personalizada!';
                    $url = 'https://wa.me/' . $phone . '/?text=' . $message;
                @endphp

                <x-button-secondary class="w-1/2 text-center" href="{{ $url }}">
                    Contato <i class="ml-1 fa-solid fa-phone"></i>
                </x-button-secondary>
            </div>
        </section>

        <section class="grid gap-2">
            @isset($shop->description)
                <p class="whitespace-pre-line"><i class="fa-solid fa-circle-info mr-2"></i> {{ $shop->description }}</p>
            @endisset
            <p class="text-gray-dark">
                <i class="fa-solid fa-calendar-days text-gray-regular mr-2"></i> Loja criada em {{ date('d/m/Y', strtotime($shop->created_at)) }}
            </p>
        </section>

        <hr/>

        @if($products->isNotEmpty())
            <button class="self-end w-fit text-gray-dark px-4 py-2 border rounded-lg border-gray-regular">
                Filtrar
                <i class="text-gray-regular ml-1 fa-solid fa-chevron-down"></i>
            </button>
        @endif

        @if($products->isEmpty())
            <p class="text-gray-dark">
                Nenhum produto por aqui ainda.
            </p>
        @else
            <section class="grid gap-4">
                {{ $products->links() }}

                <ul id="products-grid" class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($products as $product)
                        <li id="product-card" class="grid gap-2">
                            <a class="hover:-translate-y-1 transition duration-150" href="{{ route('products.show', $product->id) }}">
                                <x-image :src="$product->getImagePath()" />
                            </a>
                            <a class="truncate underline text-gray-dark hover:text-neutral-black transition duration-150"
                               href="{{ route('products.show', $product->id) }}">
                                {{ $product->name }}
                            </a>
                            <p class="font-bold text-accent-darker">
                                {{ $product->formatPrice($product->sale_price) }}
                            </p>
                        </li>
                    @endforeach
                </ul>

                {{ $products->links() }}
            </section>
        @endif
    </div>
</x-app-layout>
