<x-dashboard-layout>
    <div class="grid gap-8 w-full h-fit md:w-1/2 lg:w-2/3">
        <x-text-heading>
            Encomendas da Loja
        </x-text-heading>

        @if($shopCommissions->isEmpty()) <!-- SEM ENCOMENDAS -->
            <div class="flex flex-col items-center gap-4">
                <img class="w-1/2 md:w-1/3"
                     src="/img/assets/check-list.png"
                     alt="ilustração de caixa vazia" />
                <p class="text-gray-dark">
                    Nenhuma encomenda por aqui ainda.
                </p>
            </div>

            <hr/>
            <x-link href="{{ route('artisan.index') }}">
                Ir para a página inicial
            </x-link>
        @else
            @foreach($shopCommissions as $commission)
                <div class="rounded-lg p-4 border border-gray-200 grid gap-4">
                    <div class="flex justify-between">
                        <p class="px-3 py-1 w-fit rounded-full text-gray-dark @if($commission->status->id >= 1 and $commission->status->id < 4)
                                          bg-warning-regular
                                          @elseif($commission->status->id == 5)
                                          bg-success-regular
                                          @else
                                          bg-danger-regular
                                          @endif ">
                            {{ $commission->status->description }}
                        </p>
                        <div class="flex items-center">
                            <x-link href="{{ route('artisan.commissions.show', $commission->id) }}">
                                Ver detalhes <i class="fa-solid text-sm fa-chevron-right text-secondary-regular"></i>
                            </x-link>
                        </div>
                    </div>

                    <hr/>

                    <table class="w-full text-left">
                        <tr>
                            <th>ID</th>
                            <td>{{ $commission->id }}</td>
                        </tr>
                        <tr>
                            <th class="w-1/4">Cliente</th>
                            <td>
                                <x-link-secondary>
                                    {{ $commission->user->name }}
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
                </div>
            @endforeach

            @if($shopCommissions->count() > 1)
                <hr/>
            @endif
        @endif

    </div>
</x-dashboard-layout>
