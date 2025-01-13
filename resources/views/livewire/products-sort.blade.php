<section class="grid gap-8">
    <div>
        {{ $products->links() }}
    </div>

    <table class="w-full text-left">
        <thead>
        <tr class="bg-gray-light text-gray-dark uppercase text-sm">
            <th scope="col" class="p-3 lg:p-6 hidden md:table-cell">
                Imagem
            </th>
            <th scope="col" class="p-3 lg:p-6" x-data="{ sort: false }">
                Nome
                <button aria-label="Ordenar por nome"
                        type="button"
                        wire:click="sortBy('name')"
                        @click="sort = ! sort">
                    <i class="fa-solid ml-2 {{ $sortIconName }}"></i>
                </button>
            </th>
            <th scope="col" class="p-3 lg:p-6 hidden md:table-cell">
                Preço
                <button aria-label="Ordenar por preço"
                        type="button"
                        wire:click="sortBy('sale_price')">
                    <i class="fa-solid ml-2 {{ $sortIconSalePrice }}"></i>
                </button>
            </th>
            <th scope="col" class="p-3 lg:p-6 text-center">
                Excluir
            </th>
            <th scope="col" class="p-3 lg:p-6 text-center">
                Editar
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr class="border-b border-gray-light">
                <td class="p-3 py-6 lg:p-6 hidden md:table-cell text-center">
                    <x-image alt="Imagem do produto {{ $product->name }}"
                             :width="42"
                             :src="$product->getDefaultImagePath($product)" />
                </td>
                <td class="p-3 py-6 lg:p-6">
                    <x-link-secondary class="line-clamp-1" href="{{ route('products.show', $product->id) }}">
                        {{ $product->name }}
                    </x-link-secondary>
                </td>
                <td class="p-3 py-6 lg:p-6 hidden md:table-cell w-32">
                    {{ $product->formatPrice() }}
                </td>
                <td class="p-3 py-6 lg:p-6 text-center">
                    @include('artisan.products.partials.delete-product-form')
                </td>
                <td class="p-3 lg:p-6 text-center">
                    <a aria-label="Editar produto"
                       class="text-accent-dark text-2xl hover:text-accent-darker transition duration-300"
                       href="{{ route('artisan.products.edit', $product->id) }}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div>
        {{ $products->links() }}
    </div>
</section>
