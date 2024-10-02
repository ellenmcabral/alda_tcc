<x-dashboard-layout>
    <div class="grid gap-8 w-full h-fit lg:w-2/3">
        <div class="hidden sm:inline-flex">
            {{ Breadcrumbs::render('products.create') }}
        </div>

        <x-text-heading>
            Adicionar Produto
        </x-text-heading>

        <x-form-product :route="route('artisan.products.store')"
                        :categories="$categories"  />
    </div>
</x-dashboard-layout>
