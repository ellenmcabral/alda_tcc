<x-app-layout>
    <x-slot:breadcrumbs>
        @auth
            {{ Breadcrumbs::render('products.show', $product->category, $product) }}
        @else
            {{ Breadcrumbs::render('products.show.loggedOut', $product->category, $product) }}
        @endauth
    </x-slot:breadcrumbs>

    <div class="grid gap-8 h-fit lg:px-8">
        <div class="grid md:grid-cols-[60%_auto] gap-16">
            <div class="grid gap-4 @if($productImages->count() > 1) md:grid-cols-[auto_80%] @endif"
                 x-data="{ imageUrl: '{{ $product->getDefaultImagePath() }}' }" >

                @if($productImages->count() > 1)
                    <div class="grid grid-cols-5 order-last md:order-none gap-2 md:grid-cols-1 h-fit">
                        @foreach($productImages as $productImage)
                            <x-image class="cursor-pointer hover:opacity-75 transition duration-300"
                                     src="{{ $productImage->getImagePath() }}"
                                     alt="Imagem de {{ $productImage->product->name }}"
                                     x-on:click="imageUrl = '{{$productImage->getImagePath()}}'" />
                        @endforeach
                    </div>
                @endif

                <img class="w-full object-cover aspect-square h-full"
                     :src="imageUrl"
                     alt="Imagem de {{ $product->name }}"/>
            </div>

            <div class="flex flex-col gap-10 h-fit">
                <section class="flex flex-col gap-4">
                    <x-text-heading class="font-bold text-2xl">
                        {{ $product->name }}
                    </x-text-heading>

                    <x-text-heading class="text-accent-darker">
                        {{ $product->formatPrice() }}
                    </x-text-heading>
                </section>

                <section class="grid gap-1">
                    @if($product->deadline > 0)
                        <x-text-subheading>
                            Sob Encomenda
                        </x-text-subheading>
                        <x-text class="text-gray-dark">
                            <i class="text-gray-regular mr-1 fa-solid fa-clock"></i> Prazo de produção de <span class="font-bold">{{ $product->deadline }} dias úteis</span>
                        </x-text>
                    @elseif($product->stock > 0)
                        <x-text-subheading>
                            Pronta-entrega
                        </x-text-subheading>
                        <x-text class="text-gray-600">
                            <i class="text-gray-regular mr-1 fa-solid fa-box"></i> {{ $product->stock }} unidades disponíveis
                        </x-text>
                    @endif
                </section>

                <div>
                    @if($product->is_active == true)
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
                    @else
                        <x-text class="text-danger-dark font-bold uppercase">Produto indisponível</x-text>
                    @endif
                </div>

                <section class="h-fit w-full flex flex-col gap-4 border border-gray-regular p-4 rounded-lg">
                    <div>
                        <x-text-subheading>
                            Loja
                        </x-text-subheading>
                        <x-text>
                            <x-link-secondary href="{{ route('shop.show', $product->shop->url) }}">
                                {{ $product->shop->name }}
                            </x-link-secondary>
                        </x-text>
                    </div>

                    <hr/>

                    <div class="flex flex-col gap-4">
                        <div class="w-full flex justify-between">
                            <x-text>
                                <i class="mr-1 text-gray-regular fa-solid fa-calendar-days"></i>
                                Desde {{ $product->shop->formatDate() }}
                            </x-text>
                            <x-text>
                                <i class="mr-1 text-gray-regular fa-solid fa-tags"></i>
                                {{ $product->shop->products()->count() }} produtos
                            </x-text>
                        </div>

                        <x-link class="self-end flex items-center gap-1"
                                href="{{ route('shop.show', $product->shop->url) }}">
                            Ver loja <i class="text-secondary-regular fa-solid fa-chevron-right"></i>
                        </x-link>
                    </div>
                </section>
            </div>
        </div>

        <section class="grid gap-2">
            <x-text-subheading>
                Descrição do produto
            </x-text-subheading>
            <x-text>{{ $product->description }}</x-text>
        </section>

        <x-tag class="w-fit"
               href="{{ route('categories.products.index', $product->category->id) }}">
            <i class="fa-solid fa-list mr-2"></i>{{ $product->category->description }}
        </x-tag>
    </div>
</x-app-layout>
