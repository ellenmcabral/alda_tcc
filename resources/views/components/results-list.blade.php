@if($results->isEmpty())
    <span class="h-40 w-full bg-gray-200"></span>
    <p class="text-gray-600 text-sm">
        Nenhum resultado encontrado.
    </p>
@else
    <section class="grid gap-4">
        {{ $results->links() }}

        <div id="products-grid" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($results as $result)
                <ul id="product-card" class="grid gap-2">
                    @if($searchType == 'Produtos')
                        <li>
                            <img class="w-full rounded-lg"
                                 src="/img/products/{{ $result->image }}"
                                 alt="Imagem de {{ $result->name }}"/>
                        </li>
                    @endif

                    <li>
                        <h2 class="truncate underline text-gray-900 hover:text-gray-600 transition duration-150">
                            <a href="{{ route('products.show', $result) }}">
                                {{ $result->name }}
                            </a>
                        </h2>
                    </li>

                    @if($searchType == 'Produtos')
                        <li class="flex justify-between items-center">
                            <p class="font-bold text-secondary-300">
                                {{ $result->priceFormat($result->sale_price) }}
                            </p>
                            <x-link-button class="h-8 w-fit" href="{{ route('products.show', $result) }}">
                                Ver Detalhes
                            </x-link-button>
                        </li>
                    @elseif($searchType == 'Lojas')
                        <li class="flex justify-end">
                            <x-link-button class="w-full" href="{{ route('shop.show', $result->url) }}">
                                Ver Detalhes
                            </x-link-button>
                        </li>
                    @endif
                </ul>
            @endforeach
        </div>

        {{ $results->links() }}
    </section>
@endif
