<section id="products-info" class="grid gap-4">
    <header class="flex items-center gap-2">
        <i class="fa-solid fa-bag-shopping"></i>
        <h3 class="text-xl font-bold">
            Resumo de Itens
        </h3>
    </header>
    <p class="text-sm text-gray-600">
        Encomenda para a loja
        <a class="underline hover:text-gray-400 transition ease-in-out duration-150"
           href="{{ route('shop.show', $commission->shop->url) }}">
            {{ $commission->shop->name }}
        </a>
    </p>

    @foreach($commissionProducts as $commissionProduct)
        <ul class="flex items-center justify-between">
            <li class="flex gap-2 items-center">
                <img class="h-16 rounded-lg"
                     src="/img/products/{{ $commissionProduct->product->image }}"
                     alt="Imagem de {{ $commissionProduct->product->name }}"/>
                {{ $commissionProduct->quantity }} x
                <x-link class="ml-2" href="{{ route('products.show', $commissionProduct->product->id) }}">
                    {{ $commissionProduct->product->name }}
                </x-link>
            </li>
            <li class="justify-end">
                <p class="text-gray-400">
                    R$ {{ number_format($commissionProduct->sale_price, 2, ',', '.') }}
                </p>
                <h3 class="font-bold">
                    R$ {{ number_format($commissionProduct->total, 2, ',', '.') }}
                </h3>
            </li>
        </ul>
        <hr/>
    @endforeach
</section>
