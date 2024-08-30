<x-app-layout>
    <x-slot name="heading">
        Sacola de Compras @if($items->count() > 0) <span class="px-4 bg-secondary-300 rounded-full">{{ $items->count() }}</span> @endif
    </x-slot>

    <section class="grid gap-8">
        @if($items->isEmpty())
            <span class="h-40 w-full bg-gray-200"></span>
            <p class="text-gray-600 text-sm">
                Sua sacola está vazia.
            </p>
            <hr/>
            <x-link href="{{ route('home') }}">
                Ir para a página inicial
            </x-link>
        @else
            <p class="text-gray-600">
                @if($items->count() == 1)
                    Sua sacola tem {{ $items->count() }} item
                @else
                    Sua sacola tem {{ $items->count() }} itens
                @endif
                da loja

                <a class="underline font-semibold hover:text-gray-400 transition ease-in-out duration-150"
                   href="{{ route('shop.show', $shop->url) }}">
                    {{ $shop->name }}
                </a>
            </p>
            @foreach($items as $item)
                <ul class="flex flex-col gap-4">
                    <li class="flex items-center justify-between">
                        <p class="flex items-center">
                            <img class="w-16 rounded" src="/img/products/{{ $item->options->image }}" alt="Imagem de {{ $item->name }}"/>
                            <a class="font-bold pl-4 text-xl" href="{{ route('products.show', $item->id) }}">
                                {{ $item->name }}
                            </a>
                        </p>
                        <div class="flex items-center">
                            <form action="{{ route('cart.update', $item->rowId) }}" method="post">
                                @csrf @method('patch')

                                <input type="hidden" name="decrement" value="decrement">
                                <input type="hidden" name="quantity" value="{{ $item->qty }}">

                                <button class="flex items-center px-2 h-6 border border-gray-400 rounded" type="submit">
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

                                <button type="submit" class="bg-secondary-300 rounded px-2 h-6">
                                    +
                                </button>
                            </form>
                        </div>
                    </li>
                    <li class="flex justify-between items-center">
                        <p class="font-bold text-gray-400">
                            R$ {{ number_format($item->price, 2, ',', '.') }}
                        </p>
                        <form action="{{ route('cart.remove', $item->rowId) }}" method="post">
                            @csrf @method('delete')
                            <button class="text-gray-400 underline">
                                Remover<i class="ml-2 fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </li>
                </ul>

                <hr/>
            @endforeach

            <div>
                <h2 class="flex justify-between font-semibold text-2xl text-gray-400">
                    Subtotal: <span>R$ {{ \Cart::subtotal(2, ',', '.') }}</span>
                </h2>
                <div class="mt-4 flex gap-4 justify-between">
                    <x-link-button class="w-full uppercase" href="{{ route('cart.destroy') }}">
                        Limpar sacola
                    </x-link-button>
                    <x-link-button :background="'primary'" class="w-full uppercase" href="{{ route('checkout.index') }}">
                        Continuar encomenda
                    </x-link-button>
                </div>
            </div>
        @endif
    </section>
</x-app-layout>
