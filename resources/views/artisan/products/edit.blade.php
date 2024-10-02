<x-dashboard-layout>
    <div class="w-full h-fit grid gap-8 lg:w-2/3">
        <div class="hidden sm:inline-flex">
            {{ Breadcrumbs::render('products.edit', $product->name) }}
        </div>

        <x-text-heading>
            Editar Produto "{{ $product->name }}"
        </x-text-heading>

        <x-form-product :route="route('artisan.products.update', $product->id)"
                        :method="'patch'"
                        :product="$product"
                        :categories="$categories"  />

    </div>
</x-dashboard-layout>
