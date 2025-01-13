<x-dashboard-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('deleted-products') }}
    </x-slot:breadcrumbs>

    <div class="w-full h-fit grid gap-8 md:w-2/3">
        @if($products->isEmpty()) <!-- SEM PRODUTOS -->
        <div class="flex flex-col items-center gap-8">
            <img class="w-48"
                 src="\img\assets\price-tag.png"
                 alt="Ilustração de etiqueta de preço" />
            <x-text class="text-gray-dark">
                Nenhum produto por aqui.
            </x-text>
            <x-link href="{{ route('artisan.index') }}">
                Ir para a página inicial
            </x-link>
        </div>
        @else
            {{ $products->links() }}

            <ul class="w-full">
                @foreach($products as $product)
                    <li class="flex w-full justify-between py-8 items-center">
                        <x-image alt="Imagem do produto {{ $product->name }}"
                                 :width="42"
                                 :src="$product->getDefaultImagePath($product)" />

                        <x-link-secondary class="w-1/2 h-fit line-clamp-1" href="{{ route('products.show', $product->id) }}">
                            {{ $product->name }}
                        </x-link-secondary>

                        <x-text class="font-bold">
                            {{ $product->formatPrice() }}
                        </x-text>

                        <form method="post" action="{{ route('artisan.products.activate', $product->id) }}">
                            @csrf
                            @method('patch')

                            <button class="border-2 border-gray-dark text-gray-dark rounded-lg uppercase font-bold px-4 py-2 hover:bg-gray-regular hover:bg-opacity-10 transition duration-300" type="submit">
                                Ativar produto
                            </button>
                        </form>
                    </li>

                    <hr/>
                @endforeach
            </ul>

            {{ $products->links() }}
        @endif
    </div>
</x-dashboard-layout>
