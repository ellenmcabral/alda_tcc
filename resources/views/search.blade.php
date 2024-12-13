<x-app-layout>
    <x-slot:heading>
        @if($searchText == '')
            Exibindo todos resultados de {{ $searchType }}
        @else
            Exibindo resultados para "{{ $searchText }}"
        @endif
    </x-slot:heading>

    <div class="grid @if($searchType == 'Produtos') lg:flex @endif gap-8 h-fit w-full lg:px-8">
        @if($searchType == 'Produtos')
            <section class="hidden lg:flex lg:flex-col w-44">
                <x-text-subheading>Categorias de artesanato</x-text-subheading>
                <ul class="mt-4 grid gap-2 border-r-2 border-accent-light pr-4">
                    @foreach($categories as $category)
                        <li>
                            <x-link-secondary href="{{ route('categories.products.index', $category->id) }}">
                                {{ $category->description }}
                            </x-link-secondary>
                        </li>
                    @endforeach
                </ul>
            </section>
       @endif

        <livewire:search :search="$searchText" :searchType="$searchType" />
    </div>
</x-app-layout>
