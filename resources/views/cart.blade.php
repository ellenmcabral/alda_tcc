<x-app-layout>
    <x-slot:heading>
        Sacola de Compras
    </x-slot:heading>
    <div class="grid gap-8 w-full h-fit md:w-1/2 xl:w-1/3">

        @if($items->isEmpty()) <!-- SACOLA VAZIA -->
            <div class="flex flex-col items-center gap-8">
                <img class="w-1/2 md:w-1/3"
                     src="\img\assets\shopping-bag.png"
                     alt="ilustração de sacola" />
                <p class="text-gray-dark">
                    Sua sacola está vazia.
                </p>

                <x-link href="{{ route('home') }}">
                    Voltar para a página inicial
                </x-link>
            </div>
        @else <!-- SACOLA COM ITENS -->
            <p class="text-lg">
                Sua sacola tem
                @if($items->count() == 1)
                    <span class="font-bold">{{ $items->count() }} item</span>
                @else
                    <span class="font-bold">{{ $items->count() }} itens</span>
                @endif
                da loja
                <x-link href="{{ route('shop.show', $shop->url) }}">
                    {{ $shop->name }}
                </x-link>
            </p>

            <div class="flex justify-between">
                <x-link-secondary href="{{ route('home') }}">
                    Voltar para o início
                </x-link-secondary>
                <x-link-secondary href="{{ route('cart.destroy') }}">
                    Limpar sacola
                </x-link-secondary>
            </div>

            <ul class="flex flex-col gap-8">
                @foreach($items as $item)
                    <hr/>

                    <li>
                        <div class="flex justify-between items-center gap-2">
                            <a class="flex items-center gap-2"
                               href="{{ route('products.show', $item->id) }}">

                                <x-image :width="48"
                                         src="/img/products/{{ $item->options->image }}" />

                                <span class="line-clamp-1">
                                        {{ $item->name }}
                                </span>
                            </a>
                            <p class="font-bold text-neutral-black w-full text-right">
                                R$ {{ number_format($item->price, 2, ',', '.') }}
                            </p>
                        </div>

                        <div class="mt-4 flex justify-between items-center">
                            <form action="{{ route('cart.remove', $item->rowId) }}"
                                  method="post">
                                @csrf
                                @method('delete')

                                <button class="text-gray-dark hover:text-neutral-black transition duration-300">
                                    <i class="mr-2 fa-solid text-sm fa-trash text-gray-regular"></i>
                                    <span class="underline">
                                        Remover
                                    </span>
                                </button>
                            </form>
                            <div class="flex items-center">
                                <form action="{{ route('cart.update', $item->rowId) }}"
                                      method="post">
                                    @csrf
                                    @method('patch')

                                    <input type="hidden"
                                           name="decrement"
                                           value="decrement">

                                    <input type="hidden"
                                           name="quantity"
                                           value="{{ $item->qty }}">

                                    <button class="flex items-center justify-center font-bold px-2 w-10 h-8 border border-gray-dark rounded text-accent-darker"
                                            type="submit">
                                        -
                                    </button>
                                </form>

                                <p class="px-4">
                                    {{ $item->qty }}
                                </p>

                                <form action="{{ route('cart.update', $item->rowId) }}"
                                      method="post">
                                    @csrf @method('patch')

                                    {{--                        <input class="w-8 rounded border-gray-400"--}}
                                    {{--                               type="number"--}}
                                    {{--                               name="quantity"--}}
                                    {{--                               value="{{ old('qty', $item->qty) }}"--}}
                                    {{--                               required />--}}


                                    <input type="hidden"
                                           name="increment"
                                           value="increment">

                                    <input type="hidden"
                                           name="quantity"
                                           value="{{ $item->qty }}">

                                    <button class="font-bold text-neutral-white rounded px-2 w-10 h-8 bg-accent-darker"
                                            type="submit">
                                        +
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <hr/>

            <div class="flex flex-col gap-8">
                <x-text-heading class="text-secondary-regular flex justify-between">
                    Subtotal <span>R$ {{ \Cart::subtotal(2, ',', '.') }}</span>
                </x-text-heading>
                <a class="w-full h-fit uppercase text-center font-bold text-neutral-white border-solid bg-secondary-regular hover:bg-secondary-dark p-3 rounded-lg transition duration-300" href="{{ route('checkout.index') }}">
                    Continuar pedido
                    <i class="ml-2 fa-solid fa-chevron-right"></i>
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
