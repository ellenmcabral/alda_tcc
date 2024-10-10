<x-dashboard-layout>
    <x-slot:heading>
        Encomendas
    </x-slot:heading>
    <div class="w-full h-fit grid gap-8 md:px-8">
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
                    <article class="rounded-lg p-4 border border-gray-200 grid gap-4">
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
                    </article>
                @endforeach
            </section>
        @endif
    </div>
</x-dashboard-layout>
