<div class="grid gap-8">
    @if($results->count() > 0)
        <div class="w-full flex justify-between">
            <p class="text-gray-dark">
                Foram encontrados <span class="font-bold">{{ $results->count() }}</span> resultados
            </p>

            <div>
                <x-input-select wire:model.change="filter">
                    <option>Filtrar</option>
                    <option value="alphabetical_order">Ordem alfabética</option>
                    @if($searchType == 'Produtos')
                        <option value="lowest_sale_price">Menor preço</option>
                        <option value="highest_sale_price">Maior preço</option>
                    @endif
                    <option value="most_recent">Mais recente</option>
                </x-input-select>
            </div>
        </div>
    @endif

    <x-results-list :results="$results" :searchType="$searchType" />
</div>
