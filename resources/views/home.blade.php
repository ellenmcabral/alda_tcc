<x-app-layout>
    <div class="w-full grid gap-16 md:w-2/3">
        <section class="grid gap-4">
            <div class="grid gap-4 p-4 lg:p-6 bg-gray-50 border border-gray-dark rounded-lg z-10">
                @can('activate shop')
                    <div class="z-10 p-6 flex items-center gap-2 bg-warning-regular rounded border border-warning-dark">
                        <i class="text-warning-dark fa-solid fa-triangle-exclamation"></i>
                        <p class="text-neutral-black">
                            Certifique-se de
                            <a class="underline hover:text-yellow-900 transition ease-in-out duration-150"
                               href="{{ route('shop.activate') }}" >
                                ativar a sua loja
                            </a>
                            para poder acessar o Painel de Controle do Artesão.
                        </p>
                    </div>
                @endcan
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
                    <img class="w-1/3 xl:w-40"
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
            <div class="relative overflow-hidden h-96 lg:hidden">
                @foreach($products as $product)
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <a href="{{ route('products.show', $product->id) }}">
                            <img src="/img/products/{{ $product->image }}"
                                 alt="Imagem do produto {{ $product->name }}"
                                 class="object-cover aspect-square absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        </a>
                        <p class="text-lg absolute top-5 right-5 font-bold rounded text-accent-darker px-4 py-2 bg-white">
                            {{ $product->formatPrice() }}
                        </p>
                        <h3 class="text-lg absolute left-0 bottom-0 bg-white w-full py-2 line-clamp-1 font-bold">
                            {{ $product->name }}
                        </h3>
                    </div>
                @endforeach

                <!-- Slider controls -->
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-800/30 group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-gray-light rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-800/30 group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-gray-light rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
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
                        <x-image :src="$product->getImagePath()"
                                 class="rounded-lg" />
                        <div class="flex justify-between">
                            <h3 class="font-bold line-clamp-1 h-fit w-2/3">
                                {{ $product->name }}
                            </h3>
                            <p class="font-bold rounded text-accent-darker">
                                {{ $product->formatPrice() }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>

            <x-link-secondary href="{{ route('search', ['search_type' => 'Produtos', 'search_text' => '']) }}">
                Ver mais produtos<i class="ml-1 text-sm text-gray-dark fa-solid fa-chevron-right"></i>
            </x-link-secondary>
        </section>

        <!-- CATEGORIAS -->
        <aside class="grid gap-4">
            <x-text-heading>
                Categorias
            </x-text-heading>

            <ul class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($categories as $category)
                    <li>
                        <x-tag href="{{ route('categories.products.index', $category->id) }}">
                            {{ $category->description }}
                        </x-tag>
                    </li>
                @endforeach
            </ul>

            <x-link-secondary href="{{ route('categories.index') }}">
                Ver mais categorias<i class="ml-1 text-sm text-gray-dark fa-solid fa-chevron-right"></i>
            </x-link-secondary>
        </aside>
    </div>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</x-app-layout>
