<x-dashboard-layout>
    <x-slot:heading>
        Encomendas
    </x-slot:heading>
    <div class="grid gap-8 w-full h-fit md:px-8">
        @if($shopCommissions->isEmpty()) <!-- SEM ENCOMENDAS -->
            <div class="flex flex-col items-center gap-8">
                <img class="w-48"
                     src="/img/assets/check-list.png"
                     alt="ilustração de caixa vazia" />
                <p class="text-gray-dark">
                    Sua loja não possui nenhuma encomenda
                </p>

                <x-link href="{{ route('artisan.index') }}">
                    Ir para a página inicial
                </x-link>
            </div>
        @else
            <section class="w-full grid gap-8 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
                @foreach($shopCommissions as $commission)
                    <x-card-commission :id="$commission->id"
                                       :link="route('artisan.commissions.show', $commission->id)">
                        <x-slot:status>
                            <x-tag-commission :status="$commission->status->id">
                                {{ $commission->status->description }}
                            </x-tag-commission>
                        </x-slot:status>

                        <x-slot:content>
                            <table class="w-full text-left">
                                <tr>
                                    <th class="w-1/4">Cliente</th>
                                    <td>
                                        {{ $commission->user->name }}
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
</x-dashboard-layout>
