<x-app-layout>
    <x-slot:breadcrumbs>
        @auth
            {{ Breadcrumbs::render('categories.products.index', $category) }}
        @else
            {{ Breadcrumbs::render('categories.products.index.loggedOut', $category) }}
        @endauth
    </x-slot:breadcrumbs>

    <div class="h-fit w-full lg:px-8">
        <livewire:search :searchType="'Produtos'" :category="$category" />
    </div>
</x-app-layout>
