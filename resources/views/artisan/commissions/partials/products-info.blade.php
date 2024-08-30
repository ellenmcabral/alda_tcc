<section id="products-info">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Resumo de Produtos
        </h2>
    </header>

    <table class="mt-4 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-4 ">
                Produto
            </th>
            <th scope="col" class="px-6 py-4">
                Quantidade
            </th>
            <th scope="col" class="px-6 py-4">
                Preço
            </th>
            <th scope="col" class="px-6 py-4 text-right">
                Total
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($commissionProducts as $commissionProduct)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="flex items-center py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <img style="width:50px;"
                         src="/img/products/{{ $commissionProduct->product->image }}"
                         alt="Imagem de {{ $commissionProduct->product->name }}"/>
                    <a class="pl-4"
                       href="/shop/{{ $commission->shop->url }}/{{ $commissionProduct->product->name }}">
                        {{ $commissionProduct->product->name }}
                    </a>
                </th>
                <td class="px-6 py-4">
                    {{ $commissionProduct->quantity }} x
                </td>
                <td class="px-6 py-4">
                    R$ {{ number_format($commissionProduct->sale_price, 2, ',', '.') }}
                </td>
                <td class="px-6 py-4 text-right">
                    R$ {{ number_format($commissionProduct->total, 2, ',', '.') }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2 class="flex justify-end mt-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Total: {{ number_format($commission->total, 2, ',', '.') }}
    </h2>
</section>
