<div class="grid gap-8 h-fit">
    @if($results->count() > 0)
        {{  $results->appends(Request::all())->links() }}

        <div class="w-full flex flex-col md:flex-row md:justify-between items-center gap-8">
            <div class="flex w-full justify-end">
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

    @if($results->count() == 10)
        {{  $results->appends(Request::all())->links() }}
    @endif
</div>
