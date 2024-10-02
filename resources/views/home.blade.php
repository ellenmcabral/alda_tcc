<x-app-layout>
    <div class="w-full grid gap-16 md:w-2/3">
        <section class="grid gap-4">
            @can('activate shop')
                <div class="z-10 p-6 bg-yellow-400 rounded border-5">
                    <x-text-paragraph class="text-neutral-black">
                        Certifique-se de
                        <a class="underline hover:text-yellow-900 transition ease-in-out duration-150"
                           href="{{ route('shop.activate') }}" >
                            ativar a sua loja
                        </a>
                        para poder acessar o Painel de Controle do Artesão.
                    </x-text-paragraph>
                </div>
            @endcan

            <div class="grid gap-4 p-4 lg:p-6 bg-gray-50 border border-gray-dark rounded-lg z-10">
                <div class="w-full flex justify-between">
                    <div class="flex flex-col justify-between">
                        <div class="grid gap-2">
                            <x-text-heading>
                                Oi, {{ Auth::user()->formatName() }}
                            </x-text-heading>
                            <p>
                                Bem-vindo(a) à ALDA!
                            </p>
                        </div>
                    </div>
                    <!-- FOTO GATINHO -->
                    <img class="w-1/3 lg:w-1/4"
                         src="/img/assets/cat.png"
                         alt="ilustração de gatinho" />
                </div>
                @can('create shop')
                    <div class="text-secondary-regular flex items-center">
                        <x-link class="flex items-center" href="{{ route('shop.create') }}">
                            Criar loja
                        </x-link>
                        <i class="ml-1 text-sm fa-solid fa-chevron-right"></i>
                    </div>
                @endcan
                @role('artisan')
                <div class="text-secondary-regular flex items-center">
                    <x-link class="flex items-center" href="{{ route('artisan.index') }}">
                        Acessar painel do artesão
                    </x-link>
                    <i class="ml-1 text-sm fa-solid fa-chevron-right"></i>
                </div>
                @endrole
            </div>
        </section>

        <section class="relative w-full z-0 grid gap-4"
                 data-carousel="static">
            <x-text-heading>
                Últimos Produtos
            </x-text-heading>

            <!-- SLIDER DE PRODUTOS -->
            <div class="relative overflow-hidden h-96 rounded-lg lg:hidden">
                @foreach($products as $product)
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <a href="{{ route('products.show', $product->id) }}">
                            <img src="/img/products/{{ $product->image }}"
                                 alt="Imagem do produto {{ $product->name }}"
                                 class=" absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        </a>
                        <h3 class="text-lg absolute left-5 bottom-5 bg-white w-full truncate font-bold">
                            {{ $product->name }}
                        </h3>
                        <p class="text-lg absolute top-5 right-5 font-bold rounded text-accent-darker p-4 bg-white">
                            {{ $product->formatPrice() }}
                        </p>
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

            <!-- GRADE DE PRODUTOS PARA DESKTOP -->
            <div class="hidden lg:grid lg:grid-cols-3 lg:gap-8">
                @foreach($products as $product)
                    <a class="grid gap-4"
                       href="{{ route('products.show', $product->id) }}">
                        <x-image :height="48"
                                 :src="$product->getImagePath()"
                                 class="rounded-lg" />
                        <div class="flex justify-between">
                            <h3 class="font-bold truncate">
                                {{ $product->name }}
                            </h3>
                            <p class="font-bold rounded text-accent-darker">
                                {{ $product->formatPrice() }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>

            <a class="font-bold text-gray-dark underline text-lg"
                href="{{ route('search-results', ['search_type' => 'Produtos', 'search_text' => ' ']) }}">
                Ver mais produtos<i class="ml-1 text-sm text-gray-dark fa-solid fa-chevron-right"></i>
            </a>
        </section>

        <aside class="grid gap-4">
            <x-text-heading>
                Categorias
            </x-text-heading>

            <ul class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($categories as $category)
                    <li>
                        <a class="flex justify-center w-full mr-2 px-2 py-1 rounded bg-gray-200 hover:bg-gray-300 transition ease-in-out duration-150"
                           href="{{ route('categories.products.index', $category->id) }}">
                            {{ $category->description }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <a class="font-bold text-gray-dark underline text-lg"
               href="{{ route('categories.index') }}">
                Ver mais categorias<i class="ml-1 text-sm text-gray-dark fa-solid fa-chevron-right"></i>
            </a>
        </aside>
    </div>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</x-app-layout>
