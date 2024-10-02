<x-app-layout>
    <div class="grid gap-8 w-full h-fit lg:w-2/3">
        <div class="hidden sm:inline-flex">
            {{ Breadcrumbs::render('products.show', $product->shop, $product) }}
        </div>

        <div class="grid lg:flex lg:gap-4 xl:gap-16 ">
            <img class="w-full rounded-lg lg:w-1/2 h-fit"
                 src="{{ $product->getImagePath() }}"
                 alt="Imagem de {{ $product->name }}"/>

            <div class="grid gap-8 h-fit w-full">
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
                            <x-button class="w-full" href="#">
                                Editar
                            </x-button>
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

        <section>
            <h3 class="font-bold text-lg">
                Descrição
            </h3>
            <x-text-paragraph>
                {{ $product->description }}
            </x-text-paragraph>
        </section>
    </div>
</x-app-layout>
