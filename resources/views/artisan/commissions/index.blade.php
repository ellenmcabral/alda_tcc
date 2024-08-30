<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Encomendas da Loja
        </h2>
    </x-slot>

    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($shopCommissions->isNotEmpty())
                <div class="p-2 w-auto grid sm:grid-cols-2 md:grid-cols-3 gap-6 sm:px-6 lg:px-8">
                    @foreach($shopCommissions as $commission)
                        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <p class="text-gray-400">Loja {{ $commission->shop->name }}</p>
                                <table class="mt-2 w-full text-sm text-left rtl:text-right">
                                    <tr>
                                        <th>Número</th>
                                        <td>{{ $commission->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td class="@if($commission->status->id > 1 and $commission->status->id < 6)
                                                        text-yellow-300
                                                   @else
                                                        text-green-500
                                                   @endif ">
                                            {{ $commission->status->description }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Data</th>
                                        <td>{{ date('d/m/Y', strtotime($commission->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>R$ {{ number_format($commission->total, 2, ',', '.') }}</td>
                                    </tr>
                                </table>
                                <div class="flex justify-end">
                                    <x-nav-link :href="route('artisan.commissions.show', $commission->id)">
                                        Ver Detalhes
                                    </x-nav-link>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="mx-8 mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg ">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p>
                            Nenhuma encomenda por aqui.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>
