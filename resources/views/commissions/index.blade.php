<x-app-layout>
    <x-slot:heading>
        Meus Pedidos
    </x-slot:heading>

    <div class="grid gap-8 w-full h-fit md:px-8">
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
        @else <!-- COM PEDIDOS -->
            <section class="w-full grid gap-8 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
                @foreach($commissions as $commission)
                    <x-card-commission :id="$commission->id"
                                       :link="route('commissions.show', $commission->id)">
                        <x-slot:status>
                            <x-tag-commission :status="$commission->status->id">
                                {{ $commission->status->description }}
                            </x-tag-commission>
                        </x-slot:status>

                        <x-slot:content>
                            <table class="w-full text-left">
                                <tr>
                                    <th class="w-1/4">Loja</th>
                                    <td>
                                        <x-link-secondary class="line-clamp-1" href="{{ route('shop.show', $commission->shop->url) }}">
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
                        </x-slot:content>

                        <x-slot:action>
                            Ver detalhes
                        </x-slot:action>
                    </x-card-commission>
                @endforeach
            </section>
        @endif
    </div>
</x-app-layout>
