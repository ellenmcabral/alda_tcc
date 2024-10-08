<x-app-layout>
    <div class="grid @if($searchType == 'Produtos') lg:flex @endif gap-8 h-fit w-full lg:px-8">
        @if($searchType == 'Produtos')
            <div class="hidden lg:flex w-1/2">
                <ul class="grid gap-2 border-r-2 border-accent-light pr-4">
                    <h3 class="font-bold text-lg">Categorias de artesanato</h3>
                    @foreach($categories as $category)
                        <li>
                            <x-link-secondary href="{{ route('categories.products.index', $category->id) }}">
                                {{ $category->description }}
                            </x-link-secondary>
                        </li>
                    @endforeach
                </ul>
            </div>
       @endif

        <div class="grid gap-8 h-fit">
            <x-text-heading>
                @if($searchText == '')
                    Exibindo todos resultados de {{ $searchType }}
                @else
                    Exibindo resultados para "{{ $searchText }}"
                @endif
            </x-text-heading>

            <livewire:live-search :search="$searchText" :searchType="$searchType" />
        </div>
    </div>
</x-app-layout>

