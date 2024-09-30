<x-app-layout>
    <div class="grid gap-8 w-full lg:w-1/2 xl:w-1/3">
        <section class="flex gap-4 items-center">
            <div class="p-8 rounded-full bg-gray-200">
                <!-- Shop Image -->
            </div>
            <div class="w-full grid gap-2">
                <x-text-heading>
                    {{ $shop->name }}
                </x-text-heading>
                <x-text-paragraph class="font-bold">
                    {{ $shop->formatUrl() }}
                </x-text-paragraph>
            </div>
        </section>

        <p class="text-sm text-gray-dark">
            Loja criada em {{ date('d/m/Y', strtotime($shop->created_at)) }}
        </p>

        <hr/>

        @isset($shop->description)
            <p class="whitespace-pre-line">{{ $shop->description }}</p>
        @endisset

        <section class="flex justify-between gap-4">
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
        </section>

        @if($products->isEmpty())
            <x-text-paragraph>
                Nenhum produto por aqui ainda.
            </x-text-paragraph>
        @else
            <section class="grid gap-4">
                {{ $products->links() }}

                <ul id="products-grid" class="grid grid-cols-2 gap-8">
                    @foreach($products as $product)
                        <li id="product-card" class="grid gap-2">
                            <a class="hover:-translate-y-1 transition duration-150" href="{{ route('products.show', $product->id) }}">
                                <img class="rounded-lg"
                                     src="/img/products/{{ $product->image }}"
                                     alt="Imagem de {{ $product->name }}"/>
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
