<x-app-layout>

    <x-slot name="breadcrumbs">
        {{ Breadcrumbs::render('products.show', $product->shop, $product) }}
    </x-slot>

    <ul class="mt-8 grid gap-4">
        <li>
            <img class="w-full rounded-lg"
                 src="/img/products/{{ $product->image }}"
                 alt="Imagem de {{ $product->name }}"/>
        </li>
        <li>
            <h2 class="font-semibold text-2xl">
                {{ $product->name }}
            </h2>
        </li>
        <li class="flex items-center justify-between">
            <p class="flex items-center px-2 py-1 bg-gray-200 text-gray-600 rounded-lg w-fit">
                <i class="fa-solid fa-list mr-2"></i>{{ $product->category->description }}
            </p>
            <h2 class="text-2xl font-semibold text-secondary-300">
                R$ {{ number_format($product->sale_price, 2, ',', '.') }}
            </h2>
        </li>

        @auth
            @if(Auth::user()->hasRole('artisan') && $product->shop_id == Auth::user()->shop->id)
                <li>
                    <x-button-primary class="w-full" href="#">
                        Editar
                    </x-button-primary>
                </li>
            @else
                <li>
                    <x-form-cart :action="route('cart.add')"
                                 :product="$product"
                                 :quantity="true" />
                </li>
            @endif
        @else
            <li>
                <x-form-cart :action="route('cart.add')"
                             :product="$product"
                             :quantity="true" />
            </li>
        @endauth

        @if($product->stock > 0)
            <li>
                <h3 class="font-bold text-lg">
                    Em Estoque
                </h3>
                <p class="text-gray-600">
                    {{ $product->stock }} unidades
                </p>
            </li>
        @endif
        @isset($product->deadline)
            <li>
                <h3 class="font-bold text-lg">
                    Sob Encomenda
                </h3>
                <p class="text-gray-600">
                    Prazo de produção de <span class="font-bold">{{ $product->deadline }} dias úteis</span>
                </p>
            </li>
        @endisset

        <li class="flex flex-col">
            <h3 class="font-bold text-lg">
                Descrição
            </h3>
            <p class="text-sm text-gray-600">
                {{ $product->description }}
            </p>
        </li>


    </ul>
</x-app-layout>
