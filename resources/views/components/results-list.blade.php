<div class="grid gap-8">
    @if($results->isEmpty())
        <p class="text-gray-dark">
            Nenhum resultado foi encontrado.
        </p>
    @else
        <section class="grid gap-4 grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
            @foreach($results as $result)
                <x-card>
                    @if($searchType == 'Produtos')
                        <a class="grid" href="{{ route('products.show', $result->id) }}">
                            <x-image :src="$result->getImagePath()"
                                     alt="Imagem do produto {{ $result->name }}" />
                            <span class="mt-2 line-clamp-2">
                                {{ $result->name }}
                            </span>
                            <span class="mt-4 font-bold">
                                {{ $result->formatPrice() }}
                            </span>

                            @if($result->stock)
                                <span class="grid text-green-500 text-sm">
                                    Pronta-entrega
                                    <span class="text-gray-regular">
                                        {{ $result->stock }} unidades disponíveis
                                    </span>
                                </span>
                            @else
                                <span class="text-yellow-500 text-sm">
                                    Sob encomenda
                                </span>
                            @endif
                        </a>

                        @auth
                            @if(Auth::user()->hasRole('artisan') && $result->shop_id == Auth::user()->shop->id)
                                <x-button-secondary class="w-full"
                                                    href="{{ route('artisan.products.edit', $result->id) }}">
                                    Editar <i class="fa-solid fa-pen-to-square"></i>
                                </x-button-secondary>
                            @else
                                <x-form-cart :action="route('cart.add')"
                                             :product="$result" />
                            @endif
                        @else
                            <x-form-cart :action="route('cart.add')"
                                         :product="$result" />
                        @endauth
                    @elseif($searchType == 'Lojas')
                        <a class="lg:flex lg:gap-2" href="{{ route('shop.show', $result->url) }}">
                            <x-image class="lg:w-16" src="{{ $result->getImagePath() }}" />
                            <span class=" w-full">
                                <span class="mt-2 line-clamp-1 font-bold">
                                    {{ $result->name }}
                                </span>
                                <span class="text-gray-dark line-clamp-1 font-bold">
                                    {{ $result->formatUrl() }}
                                </span>
                            </span>
                        </a>

                        <x-link class="self-end"
                                href="{{ route('shop.show', $result->url) }}">
                            Ver perfil
                        </x-link>
                    @endif
                </x-card>
            @endforeach
        </section>
    @endif
</div>
