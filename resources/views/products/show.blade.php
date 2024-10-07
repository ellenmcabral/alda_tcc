<x-app-layout>
    <div class="flex flex-col gap-8 w-full h-fit md:w-2/3">
        <div class="hidden sm:inline-flex">
            {{ Breadcrumbs::render('products.show', $product->category, $product) }}
        </div>

        <div class="grid lg:flex gap-4 xl:gap-8">
            <img class="w-full rounded-lg lg:w-1/2 h-fit"
                 src="{{ $product->getImagePath() }}"
                 alt="Imagem de {{ $product->name }}"/>

            <div class="grid gap-4 xl:gap-8 h-fit w-full">
                <x-text-heading>
                    {{ $product->name }}
                </x-text-heading>

                <section class="flex justify-between">
                    <p class="h-8 flex items-center px-2 py-1 bg-gray-200 text-gray-600 rounded-lg w-fit">
                        <i class="fa-solid fa-list mr-2"></i>{{ $product->category->description }}
                    </p>
                    <h2 class="text-lg font-bold text-accent-darker">
                        {{ $product->formatPrice() }}
                    </h2>
                </section>

                <section>
                    @isset($product->deadline)
                        <h3 class="font-bold text-lg">
                            Sob Encomenda
                        </h3>
                        <p class="text-gray-600">
                            Prazo de produção de <span class="font-bold">{{ $product->deadline }} dias úteis</span>
                        </p>
                    @endisset

                    @if($product->stock > 0)
                        <h3 class="font-bold text-lg">
                            Em Estoque
                        </h3>
                        <p class="text-gray-600">
                            {{ $product->stock }} unidades
                        </p>
                    @endif
                </section>

                <section class="w-full flex items-center justify-between">
                    @auth
                        @if(Auth::user()->hasRole('artisan') && $product->shop_id == Auth::user()->shop->id)
                            <x-button-secondary class="w-full"
                                                href="{{ route('artisan.products.edit', $product->id) }}">
                                Editar produto <i class="fa-solid fa-pen-to-square"></i>
                            </x-button-secondary>
                        @else
                            <x-form-cart :action="route('cart.add')"
                                         :product="$product"
                                         :quantity="true" />
                        @endif
                    @else
                        <x-form-cart :action="route('cart.add')"
                                     :product="$product"
                                     :quantity="true" />
                    @endauth
                </section>
            </div>
        </div>

        <section class="w-full flex gap-8 xl:gap-16 lg:flex-row flex-col-reverse">
            <div class="lg:w-1/2">
                <h3 class="font-bold text-lg">
                    Descrição
                </h3>
                <p>
                    {{ $product->description }}
                </p>
            </div>
            <div class="h-fit lg:w-1/2 flex flex-col gap-2 border border-gray-regular p-4 rounded-lg">
                <div class="flex gap-2">
                    <h3 class="text-lg">
                        Vendido por
                    </h3>
                    <x-link-secondary href="{{ route('shop.show', $product->shop->url) }}">
                        {{ $product->shop->name }}
                    </x-link-secondary>
                </div>

                <div class="w-full text-gray-dark lg:flex lg:gap-4">
                    <p>
                        <i class="mr-1 text-gray-regular fa-solid fa-calendar-days"></i>
                        Desde {{ $product->shop->formatDate() }}
                    </p>
                    <p>
                        <i class="mr-1 text-gray-regular fa-solid fa-tags"></i>
                        {{ $product->shop->products()->count() }} produtos
                    </p>
                </div>
                <x-link class="self-end"
                        href="{{ route('shop.show', $product->shop->url) }}">
                    Ver loja
                </x-link>
            </div>
        </section>
    </div>
</x-app-layout>
