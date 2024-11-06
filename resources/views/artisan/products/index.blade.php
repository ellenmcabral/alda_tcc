<x-dashboard-layout>
    <x-slot:heading>
        Produtos
    </x-slot:heading>

    <div class="w-full h-fit grid gap-8 md:w-2/3">
        <section class="flex w-full @if($products->isNotEmpty()) justify-between @else justify-end @endif">
            @if($products->isNotEmpty())
                <button class="text-gray-dark px-4 py-2 border-2 rounded-lg border-gray-regular">
                    Filtrar
                    <i class="text-gray-regular ml-1 fa-solid fa-chevron-down"></i>
                </button>
            @endif
            <x-button-secondary class="w-fit" href="{{ route('artisan.products.create') }}"
                                :color="'secondary'">
                Adicionar Produto
                <i class="text-sm fa-solid fa-plus"></i>
            </x-button-secondary>
        </section>


        @if($products->isEmpty()) <!-- SEM PRODUTOS -->
            <div class="flex flex-col items-center gap-8">
                <img class="w-48"
                     src="\img\assets\price-tag.png"
                     alt="ilustração de sacola" />
                <p class="text-gray-dark">
                    Sua loja ainda não tem nenhum produto
                </p>
                <x-link href="{{ route('artisan.index') }}">
                    Ir para a página inicial
                </x-link>
            </div>
        @else
            <section>
                <div>
                    @if($products->count() > 10)
                        {{ $products->links() }}
                    @endif
                </div>

                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-light text-gray-dark uppercase text-sm">
                            <th scope="col" class="px-6 py-3 hidden md:table-cell">
                                Imagem
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Item
                            </th>
                            <th scope="col" class="px-6 py-3 hidden md:table-cell">
                                Preço
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Remover
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Editar
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr class="border-b border-gray-light">
                            <td class="p-6 hidden md:table-cell text-center">
                                <x-image :width="42" :src="$product->getDefaultImagePath($product)" />
                            </td>
                            <td class="m-6 line-clamp-1">
                                <x-link-secondary href="{{ route('products.show', $product->id) }}">
                                    {{ $product->name }}
                                </x-link-secondary>
                            </td>
                            <td class="p-6 hidden md:table-cell w-32">
                                {{ $product->formatPrice() }}
                            </td>
                            <td class="p-6 text-center">
                                @include('artisan.products.partials.delete-product-form')
                            </td>
                            <td class="p-6 text-center">
                                <a class="text-accent-dark text-2xl hover:text-accent-darker transition duration-300"
                                   href="{{ route('artisan.products.edit', $product->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div>
                    @if($products->count() > 10)
                        {{ $products->links() }}
                    @endif
                </div>

            </section>
        @endif
    </div>
</x-dashboard-layout>
