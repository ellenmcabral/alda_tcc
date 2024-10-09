<x-app-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('products.show', $product->category, $product) }}
    </x-slot:breadcrumbs>

    <div class="grid gap-8 h-fit w-full lg:px-8">
        <section class="grid lg:flex gap-8">
            <img class="xl:w-2/3 rounded-lg h-fit"
                 src="{{ $product->getImagePath() }}"
                 alt="Imagem de {{ $product->name }}"/>

            <div class="flex flex-col gap-4 xl:gap-8 lg:w-2/3 h-fit">
                <h3 class="font-bold text-2xl">
                    {{ $product->name }}
                </h3>

                <x-text-heading class="self-end text-accent-darker">
                    {{ $product->formatPrice() }}
                </x-text-heading>

                <section class="grid gap-1">
                    @if($product->deadline > 0)
                        <h3 class="font-bold text-lg">
                            Sob Encomenda
                        </h3>
                        <p class="text-gray-dark">
                            <i class="text-gray-regular mr-1 fa-solid fa-clock"></i> Prazo de produção de <span class="font-bold">{{ $product->deadline }} dias úteis</span>
                        </p>
                    @elseif($product->stock > 0)
                        <h3 class="font-bold text-lg">
                            Pronta-entrega
                        </h3>
                        <p class="text-gray-600">
                            <i class="text-gray-regular mr-1 fa-solid fa-box"></i> {{ $product->stock }} unidades disponíveis
                        </p>
                    @endif
                </section>

                <section>
                    @auth
                        @if(Auth::user()->hasRole('artisan') && $product->shop_id == Auth::user()->shop->id)
                            <x-button-secondary class="w-full"
                                                href="{{ route('artisan.products.edit', $product->id) }}">
                                Editar <i class="fa-solid fa-pen-to-square"></i>
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

                <section class="h-fit w-full flex flex-col gap-2 border border-gray-regular p-4 rounded-lg">
                    <p>
                        Vendido por
                        <x-link-secondary href="{{ route('shop.show', $product->shop->url) }}">
                            {{ $product->shop->name }}
                        </x-link-secondary>
                    </p>

                    <div class="text-sm w-full flex flex-col gap-4 xl:flex-row xl:justify-between">
                        <div class="flex gap-4">
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
        </section>

        <section>
            <h3 class="font-bold text-lg">
                Descrição
            </h3>
            <p>
                {{ $product->description }}
            </p>
        </section>

        <x-tag class="w-fit" href="{{ route('categories.products.index', $product->category->id) }}">
            <i class="fa-solid fa-list mr-2"></i>{{ $product->category->description }}
        </x-tag>
    </div>
</x-app-layout>
