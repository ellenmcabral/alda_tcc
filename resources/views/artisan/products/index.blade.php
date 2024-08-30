<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Produtos da Loja
        </h2>
    </x-slot>
    <div class="py-12 w-full">
        <div class="p-2 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-primary-button>
                <a href="{{ route('artisan.products.create') }}">Adicionar Produto</a>
            </x-primary-button>

            @if($products->isNotEmpty())
                <div class="mt-4">
                    {{ $products->links() }}
                </div>

                @foreach($products as $product)
                    <ul class="mt-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="flex justify-between p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex items-center">
                                <li>
                                    <img style="width:60px;" src="/img/products/{{ $product->image }}" alt="Imagem de {{ $product->name }}"/>
                                </li>
                                <li class="ml-4">
                                    {{ $product->name }}
                                </li>
                            </div>
                            <div class="flex items-center">
                                <li>
                                    <x-nav-link href="{{ route('products.show', $product) }}">
                                        Ver Detalhes
                                    </x-nav-link>
                                </li>
                                <li class="ml-4">
                                    <x-secondary-button>
                                        <a href="{{ route('artisan.products.edit', $product->id) }}">
                                            Editar
                                        </a>
                                    </x-secondary-button>
                                </li>
                            </div>

                        </div>
                    </ul>
                @endforeach

                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            @else
                <div class="mt-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Nenhum produto cadastrado ainda
                    </div>
                </div>
            @endif

        </div>
    </div>

</x-dashboard-layout>
