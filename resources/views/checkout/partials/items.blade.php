<section class="grid gap-4">
    <header class="flex items-center gap-2">
        <i class="fa-solid fa-bag-shopping"></i>
        <h3 class="text-xl font-bold">
            Resumo de Itens
        </h3>
    </header>

    <p class="text-sm text-gray-600">
        Fazendo encomenda para a loja
        <a class="underline hover:text-gray-400 transition ease-in-out duration-150"
           href="{{ route('shop.show', $shop->url) }}">
            {{ $shop->name }}
        </a>
    </p>

    @foreach($items as $item)
        <ul class="flex items-center justify-between">
            <li class="flex items-center gap-2">
                {{ $item->qty }} x
                <x-link href="{{ route('products.show', $item->id) }}">
                    {{ $item->name }}
                </x-link>
            </li>
            <li class="justify-end">
                R$ {{ number_format($item->price, 2, ',', '.') }}
            </li>
        </ul>
        <hr/>
    @endforeach
    <input type="hidden" name="shop_id" value="{{ $shop->id }}" />

    <input type="hidden" name="total" value="{{ $cart_total }}" />

</section>
