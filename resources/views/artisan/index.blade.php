<x-dashboard-layout>
    <x-slot:heading>
        Painel do Artesão
    </x-slot:heading>

    <div class="flex w-full flex-col gap-16 md:w-2/3 h-fit">
        <section>
            <x-text-subheading>
                Sua loja já está ativa no link:
            </x-text-subheading>
            <div class="mt-2 flex gap-2 items-center">
                <span class="bg-accent-regular h-4 w-4 rounded-full animate-pulse"></span>
                <x-link-secondary class="line-clamp-1"
                                  href="{{ route('shop.show', Auth::user()->shop->url) }}">
                    {{ Auth::user()->shop->formatUrl() }}
                </x-link-secondary>
            </div>
        </section>

        <section>
            <div class="flex gap-2 items-start border border-gray-regular rounded-lg p-4 text-gray-dark">
                <i class="mt-3 fa-solid fa-circle-info text-gray-regular fa-xl"></i>
                <x-text>
                    Para navegar, acesse o menu superior <span class="inline-flex 2xl:hidden items-center">(<i class="text-gray-regular fa-solid fa-bars"></i>)</span> ou pressione um dos cards abaixo.
                </x-text>
            </div>
            <div class="mt-8 grid lg:grid-cols-3 gap-4 md:gap-8">
                <x-card-dashboard :route="route('artisan.products.index')"
                                  :icon="'fa-bag-shopping'"
                                  :title="'Produtos'"
                                  :text="'Crie, edite ou exclua produtos'" />

                <x-card-dashboard :route="route('artisan.commissions.index')"
                                  :icon="'fa-box-open'"
                                  :title="'Encomendas'"
                                  :text="'Organize suas encomendas'" />

                <x-card-dashboard :route="route('artisan.shop.edit')"
                                  :icon="'fa-gear'"
                                  :title="'Minha Loja'"
                                  :text="'Edite os dados da sua loja'" />
            </div>
        </section>

        @if(Auth::user()->shop->commissions()->count() != 0)
            <section class="grid gap-4">
                <x-text-heading>
                    Últimas encomendas
                </x-text-heading>
                <div class="grid gap-8 xl:grid-cols-2 2xl:grid-cols-3">
                    @foreach($commissions as $commission)
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
                </div>
            </section>
        @endif
    </div>
</x-dashboard-layout>
