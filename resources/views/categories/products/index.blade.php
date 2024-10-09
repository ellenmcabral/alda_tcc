<x-app-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('categories.products.index', $category) }}
    </x-slot:breadcrumbs>

    <div class="h-fit w-full lg:px-8">
        <livewire:live-search :searchType="'Produtos'" :category="$category" />
    </div>
</x-app-layout>
