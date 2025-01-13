<x-dashboard-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('products.index') }}
    </x-slot:breadcrumbs>

    <div class="w-full h-fit grid gap-8 md:w-2/3">
        <section class="flex w-full justify-end">
            <x-button-secondary class="w-fit" href="{{ route('artisan.products.create') }}"
                                :color="'secondary'">
                Adicionar produto
                <i class="text-sm fa-solid fa-plus"></i>
            </x-button-secondary>
        </section>


        @if($products->isEmpty()) <!-- SEM PRODUTOS -->
            <div class="flex flex-col items-center gap-8">
                <img class="w-48"
                     src="\img\assets\price-tag.png"
                     alt="Ilustração de etiqueta de preço" />
                <p class="text-gray-dark">
                    Sua loja não possui produtos.
                </p>
                <x-link href="{{ route('artisan.index') }}">
                    Ir para a página inicial
                </x-link>
            </div>
        @else
            <livewire:products-sort :shop="$shop"/>
        @endif
    </div>
</x-dashboard-layout>
