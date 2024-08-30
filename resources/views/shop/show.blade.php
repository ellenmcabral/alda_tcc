<x-app-layout>
    <header class="my-8 grid gap-4">
        <div class="flex flex-col justify-center items-center">
            <div class="h-32 w-32 rounded-full bg-gray-200">
                <!-- Shop Image -->
            </div>
            <h1 class="mt-4 font-extrabold text-4xl text-gray-800">
                {{ $shop->name }}
            </h1>
        </div>

        <hr/>

        <p class="text-sm text-gray-400">
            Criada em {{ date('d/m/Y', strtotime($shop->created_at)) }}
        </p>

        @isset($shop->description)
            <p class="whitespace-pre-line">{{ $shop->description }}</p>
        @endisset

        @php
            $phone = preg_replace('/\D/', '', $shop->user->phone);
            $message = 'Sou usuário(a) da Alda, e gostaria de fazer uma encomenda personalizada!';
            $url = 'https://wa.me/' . $phone . '/?text=' . $message;
        @endphp

        <x-link-button href="{{ $url }}">
            Fazer Encomenda Personalizada
        </x-link-button>
    </header>

    @if($products->isEmpty())
        <span class="h-40 w-full bg-gray-200"></span>
        <p class="text-gray-600 text-sm">
            Nenhum produto por aqui ainda.
        </p>
    @else
        <section class="grid gap-4">
            {{ $products->links() }}

            <div id="products-grid" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <ul id="product-card" class="grid gap-2">
                        <li>
                            <img class="w-full rounded-lg"
                                 src="/img/products/{{ $product->image }}"
                                 alt="Imagem de {{ $product->name }}"/>
                        </li>
                        <li>
                            <a class="truncate underline text-gray-900 hover:text-gray-600 transition duration-150"
                               href="{{ route('products.show', $product->url) }}">
                                {{ $product->name }}
                            </a>
                        </li>
                        <li class="flex justify-between items-center">
                            <p class="font-bold text-secondary-300">
                                {{ $product->priceFormat($product->sale_price) }}
                            </p>
                            <x-link-button class="h-8 w-fit" href="{{ route('products.show', $product->url) }}">
                                Ver Detalhes
                            </x-link-button>
                        </li>
                    </ul>
                @endforeach
            </div>

            {{ $products->links() }}
        </section>
    @endif
</x-app-layout>
