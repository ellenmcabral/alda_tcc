<div class="grid gap-4">
    <header class="flex items-center gap-2">
        <i class="fa-solid fa-bag-shopping"></i>
        <x-text-subheading>
            Resumo de Itens
        </x-text-subheading>
    </header>

    <ul class="grid gap-8">
        @foreach($items as $item)
            <x-list-item :link="route('products.show', $item->id)"
                         :image="$item->options->image">

                <x-slot:quantity>
                    {{ $item->qty }} x
                </x-slot:quantity>

                <x-slot:product>
                    {{ $item->name }}
                </x-slot:product>

                <x-slot:price>
                    R$ {{ number_format($item->price, 2, ',', '.') }}
                </x-slot:price>

                <x-slot:subtotal>
                    R$ {{ number_format($item->price * $item->qty, 2, ',', '.') }}
                </x-slot:subtotal>
            </x-list-item>
        @endforeach
    </ul>

    <input type="hidden" name="shop_id" value="{{ $shop->id }}" />

    <input type="hidden" name="total" value="{{ $cart_total }}" />

</div>
