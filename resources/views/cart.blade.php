<x-app-layout>
    <x-slot name="heading">
        Sacola de Compras
    </x-slot>

    <section class="flex flex-col gap-12 w-full sm:w-1/2 lg:w-1/3">
        @if($items->isEmpty()) <!-- SACOLA VAZIA -->
            <span class="h-40 w-full bg-gray-200"></span>
            <p class="text-gray-dark">
                Sua sacola está vazia.
            </p>
            <hr/>
            <x-link class="text-center" href="{{ route('home') }}">
                Voltar para a página inicial
            </x-link>
        @else <!-- SACOLA COM ITENS -->
            <ul class="flex flex-col gap-4">
                <p class="text-center text-gray-dark">
                    @if($items->count() == 1)
                        Sua sacola tem {{ $items->count() }} item
                    @else
                        Sua sacola tem {{ $items->count() }} itens
                    @endif
                    da loja
                    <a class="underline hover:text-gray-dark transition ease-in-out duration-150"
                       href="{{ route('shop.show', $shop->url) }}">
                        {{ $shop->name }}
                    </a>
                </p>
                @foreach($items as $item)
                    <hr/>
                    <li>
                        <div class="flex justify-between items-center gap-2">
                            <div class="flex items-center gap-2">
                                <img class="w-24 rounded" src="/img/products/{{ $item->options->image }}"
                                     alt="Imagem de {{ $item->name }}"/>
                                <p class="truncate" href="{{ route('products.show', $item->id) }}">
                                    {{ $item->name }}
                                </p>
                            </div>
                            <p class="font-bold text-neutral-black">
                                R$ {{ number_format($item->price, 2, ',', '.') }}
                            </p>
                        </div>

                        <div class="flex justify-between items-center">

                            <form action="{{ route('cart.remove', $item->rowId) }}" method="post">
                                @csrf @method('delete')
                                <button class="text-gray-dark underline">
                                    Remover<i class="ml-2 fa-solid fa-trash"></i>
                                </button>
                            </form>
                            <div class="flex items-center">
                                <form action="{{ route('cart.update', $item->rowId) }}" method="post">
                                    @csrf @method('patch')

                                    <input type="hidden" name="decrement" value="decrement">
                                    <input type="hidden" name="quantity" value="{{ $item->qty }}">

                                    <button class="flex items-center justify-center font-bold px-2 w-10 h-8 border border-gray-dark rounded text-secondary-regular" type="submit">
                                        -
                                    </button>
                                </form>

                                <p class="px-4">
                                    {{ $item->qty }}
                                </p>

                                <form action="{{ route('cart.update', $item->rowId) }}" method="post">
                                    @csrf @method('patch')

                                    {{--                        <input class="w-8 rounded border-gray-400"--}}
                                    {{--                               type="number"--}}
                                    {{--                               name="quantity"--}}
                                    {{--                               value="{{ old('qty', $item->qty) }}"--}}
                                    {{--                               required />--}}


                                    <input type="hidden" name="increment" value="increment">
                                    <input type="hidden" name="quantity" value="{{ $item->qty }}">

                                    <button type="submit" class="font-bold text-neutral-white bg-secondary-regular rounded px-2 w-10 h-8">
                                        +
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="flex flex-col gap-8">
                <h2 class="flex justify-between font-extrabold text-4xl text-secondary-regular">
                    Subtotal: <span>R$ {{ \Cart::subtotal(2, ',', '.') }}</span>
                </h2>
                <a class="w-full h-fit lg:w-fit uppercase text-center font-bold text-neutral-white border-solid bg-secondary-regular hover:bg-secondary-dark p-3 rounded-lg transition duration-300" href="{{ route('checkout.index') }}">
                    Continuar encomenda
                    <i class="ml-2 fa-solid fa-chevron-right"></i>
                </a>
                <div class="flex justify-between">
                    <a class="w-fit underline hover:text-gray-dark transition ease-in-out duration-150"
                       href="{{ route('home') }}">
                        Voltar para o início
                    </a>
                    <a class="w-fit underline hover:text-gray-dark transition ease-in-out duration-150"
                       href="{{ route('cart.destroy') }}">
                        Limpar sacola
                    </a>
                </div>
            </div>
        @endif
    </section>
</x-app-layout>
