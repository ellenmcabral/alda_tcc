<x-app-layout>
    <div class="grid gap-8 h-fit w-full lg:px-8">
        <div class="hidden sm:inline-flex">
            {{ Breadcrumbs::render('categories.products.index', $category) }}
        </div>

        <x-text-heading>
            Exibindo resultados para "{{ $category->description }}"
        </x-text-heading>

        <livewire:live-search :searchType="'Produtos'" :category="$category" />
    </div>
</x-app-layout>
