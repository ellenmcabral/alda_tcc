<section class="grid gap-4">
    <header class="flex items-center gap-2">
        <i class="fa-solid fa-bag-shopping"></i>
        <x-text-subheading>
            Resumo de Itens
        </x-text-subheading>
    </header>

    <table>
        <thead>
            <tr class="text-accent-darker text-sm uppercase">
                <th class="py-4 text-left">
                    Nome do item
                </th>
                <th class="py-4 text-center">
                    Quantidade
                </th>
                <th class="py-4 text-center">
                    Preço unitário
                </th>
                <th class="py-4 text-right">
                    Subtotal
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr class="border-b-1 border-gray-light">
                    <th class="py-4 font-normal text-left">
                        {{ $item->name }}
                    </th>
                    <th class="py-4 font-normal text-center">
                        {{ $item->qty }}
                    </th>
                    <th class="py-4 font-normal text-center">
                        R$ {{ number_format($item->price, 2, ',', '.') }}
                    </th>
                    <th class="py-4 font-bold text-right">
                        R$ {{ number_format($item->price * $item->qty, 2, ',', '.') }}
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>

    <input type="hidden" name="shop_id" value="{{ $shop->id }}" />

    <input type="hidden" name="total" value="{{ $cart_total }}" />

</section>
