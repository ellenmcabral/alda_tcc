<section class="grid gap-4">
    <header class="flex items-center gap-2">
        <i class="fa-solid fa-bag-shopping"></i>
        <x-text-subheading>
            Resumo de Itens
        </x-text-subheading>
    </header>

    <table class="w-full">
        <thead>
            <tr class="bg-gray-light text-gray-dark uppercase text-sm">
                <th class="px-6 py-3 hidden md:table-cell text-left">
                    Imagem
                </th>
                <th class="px-6 py-3 text-left">
                    Item
                </th>
                <th class="px-6 py-3">
                    Qtd
                </th>
                <th class="px-6 py-3">
                    Preço
                </th>
                <th class="px-6 py-3 text-right hidden md:table-cell">
                    Subtotal
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr class="border-b border-gray-light">
                    <td class="p-6 text-left hidden md:table-cell">
                        <x-image :width="10" src="/img/products/{{ $item->options->image }}" />
                    </td>
                    <th scope="row" class="p-6 font-normal text-left truncate">
                        <a class="text-gray-dark underline" href="{{ route('products.show', $item->id) }}">
                            {{ $item->name }}
                        </a>
                    </th>
                    <td class="p-6 font-normal text-center">
                        {{ $item->qty }}
                    </td>
                    <td class="p-6 font-normal text-center">
                        R$ {{ number_format($item->price, 2, ',', '.') }}
                    </td>
                    <td class="p-6 font-bold text-right text-accent-darker hidden md:table-cell">
                        R$ {{ number_format($item->price * $item->qty, 2, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <input type="hidden" name="shop_id" value="{{ $shop->id }}" />

    <input type="hidden" name="total" value="{{ $cart_total }}" />

</section>
