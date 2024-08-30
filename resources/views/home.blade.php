<x-app-layout>
    <div class="grid gap-16">
        <section class="grid gap-4">
            @can('activate shop')
                <div class="mt-4 p-6 bg-yellow-400 rounded border-5">
                    <p class="font-medium text-sm">
                        Certifique-se de
                        <a href="{{ route('shop.activate') }}" class="underline hover:text-yellow-900 transition ease-in-out duration-150" href="">
                            ativar a sua loja
                        </a>
                        para poder acessar o Painel de Controle do Artesão
                    </p>
                </div>
            @endcan
            <div>
                <h1 class="font-extrabold text-3xl mt-4">
                    Oi, {{ Auth::user()->name }}
                </h1>
                <p class="mt-2">
                    Bem-vindo(a) à ALDA
                </p>
            </div>
        </section>

        <section class="relative w-full" data-carousel="static">
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-extrabold text-2xl">
                    Últimos Produtos
                </h2>
                <a class="underline text-secondary-300 hover:text-secondary-500 transition ease-in-out duration-150"
                   href="{{ route('search-results', ['search_type' => 'Produtos', 'search_text' => ' ']) }}">
                    Ver mais
                </a>
            </div>

            <div class="relative overflow-hidden h-96 rounded-lg sm:hidden">
                @foreach($products as $product)
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <a href="{{ route('products.show', $product->url) }}">
                            <img src="/img/products/{{ $product->image }}"
                                 alt="Imagem do produto {{ $product->name }}"
                                 class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        </a>
                        <div>
                            <h3 class="absolute bottom-0 bg-white p-2 w-full font-extrabold">{{ $product->name }}</h3>
                            <p class="absolute top-5 right-5 font-extrabold rounded text-secondary-300 bg-white p-2">{{ $product->priceFormat($product->sale_price) }}</p>
                        </div>
                    </div>

                @endforeach

                <!-- Slider controls -->
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-800/30 group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-800/30 group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
                </button>
            </div>

            <div class="hidden sm:grid sm:grid-cols-3 sm:gap-4">
                @foreach($products as $product)
                    <div>
                        <img src="/img/products/{{ $product->image }}"
                             alt="Imagem do produto {{ $product->name }}"
                             class="rounded-lg">
                        <div class="flex justify-between mt-2">
                            <h3 class="font-extrabold">{{ $product->name }}</h3>
                            <p class="font-extrabold rounded text-secondary-300">{{ $product->priceFormat($product->sale_price) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <aside>
            <div class="flex justify-between mb-4 items-center">
                <h2 class="font-extrabold text-2xl">
                    Categorias de Artesanato
                </h2>
                <a class="underline text-secondary-300 hover:text-secondary-500 transition ease-in-out duration-150"
                   href="{{ route('categories.index') }}">
                    Ver mais
                </a>
            </div>

            <ul class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                @foreach($categories as $category)
                    <li>
                        <a class="flex justify-center w-full mr-2 px-2 py-1 rounded bg-gray-200 hover:bg-gray-300 transition ease-in-out duration-150"
                           href="{{ route('categories.products.index', $category->id) }}">
                            {{ $category->description }}
                        </a>
                    </li>
                @endforeach
            </ul>


        </aside>
    </div>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</x-app-layout>
