<div class="grid gap-8">
    @if($results->isEmpty())
        <x-text class="text-gray-dark">
            Nenhum resultado foi encontrado.
        </x-text>
    @else
        <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
            @foreach($results as $result)
                <x-card>
                    @if($searchType == 'Produtos')
                        <a class="grid"
                           href="{{ route('products.show', $result->id) }}">
                            <x-image :src="$result->getDefaultImagePath()"
                                     alt="Imagem do produto {{ $result->name }}" />
                            <span class="mt-2 line-clamp-2 h-16">
                                {{ $result->name }}
                            </span>
                            <span class="font-bold">
                                {{ $result->formatPrice() }}
                            </span>

                            @if($result->stock)
                                <span class="grid gap-2 mt-2 text-sm">
                                    <span class="px-2 py-1 border border-green-500 rounded-lg w-fit">Pronta-entrega</span>
                                    <span class="text-gray-dark">
                                        {{ $result->stock }} unidades disponíveis
                                    </span>
                                </span>
                            @else
                                <span class="grid gap-2 mt-2 text-sm">
                                    <span class="px-2 py-1 border border-yellow-500 rounded-lg w-fit">Sob encomenda</span>
                                    <span class="text-gray-dark">
                                        {{ $result->deadline }} dias úteis
                                    </span>
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
                            <x-image class="lg:w-16"
                                     alt="Imagem da loja {{ $result->name }}"
                                     src="{{ $result->getImagePath() }}" />
                            <span class=" w-full">
                                <span class="mt-2 line-clamp-1 font-bold lg:w-3/4">
                                    {{ $result->name }}
                                </span>
                                <span class="text-gray-dark line-clamp-1 font-bold lg:w-3/4">
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
