<x-app-layout>
    <div class="grid gap-8 w-full h-fit md:w-2/3">
        <x-text-heading>
            Meus Pedidos
        </x-text-heading>

        @if($commissions->isEmpty()) <!-- SEM PEDIDOS -->
            <section class="flex flex-col gap-8 items-center">
                <img class="w-48"
                     src="img\assets\empty-orders.png"
                     alt="ilustração de caixa vazia" />
                <p class="text-gray-dark">
                    Nenhum pedido por aqui ainda.
                </p>
                <x-link class="text-center" href="{{ route('home') }}">
                    Ir para a página inicial
                </x-link>
            </section>
        @else
            <section class="w-full grid gap-8 xl:grid-cols-2 2xl:grid-cols-3">
                @foreach($commissions as $commission)
                    <div class="rounded-lg p-4 border border-gray-200 grid gap-4">
                        <div class="flex justify-between">
                            <p class="text-sm px-3 py-1 w-fit rounded-full text-gray-dark @if($commission->status->id >= 1 and $commission->status->id < 4)
                                          bg-warning-regular
                                          @elseif($commission->status->id == 5)
                                          bg-success-regular
                                          @else
                                          bg-danger-regular
                                          @endif ">
                                {{ $commission->status->description }}
                            </p>
                        </div>
                        <hr/>
                        <table class="w-full text-left">
                            <tr>
                                <th>ID</th>
                                <td>{{ $commission->id }}</td>
                            </tr>
                            <tr>
                                <th class="w-1/4">Loja</th>
                                <td>
                                    <x-link-secondary href="{{ route('shop.show', $commission->shop->url) }}">
                                        {{ $commission->shop->name }}
                                    </x-link-secondary>
                                </td>
                            </tr>
                            <tr>
                                <th>Data</th>
                                <td>{{ $commission->formatDate() }}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>{{ $commission->formatPrice() }}</td>
                            </tr>
                        </table>
                        <div class="flex justify-end">
                            <x-link href="{{ route('commissions.show', $commission->id) }}">
                                Ver detalhes <i class="fa-solid text-sm fa-chevron-right text-secondary-regular"></i>
                            </x-link>
                        </div>
                    </div>
                @endforeach
            </section>
        @endif
    </div>
</x-app-layout>
