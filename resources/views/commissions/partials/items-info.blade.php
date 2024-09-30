<section id="products-info" class="grid gap-4">
    <header class="flex items-center gap-2">
        <i class="fa-solid fa-bag-shopping"></i>
        <x-text-subheading>
            Resumo de Itens
        </x-text-subheading>
    </header>

    @foreach($commissionProducts as $commissionProduct)
        <ul class="flex items-center justify-between">
            <li class="flex gap-2 items-center">
                <img class="h-16 rounded-lg"
                     src="/img/products/{{ $commissionProduct->product->image }}"
                     alt="Imagem de {{ $commissionProduct->product->name }}"/>
                {{ $commissionProduct->quantity }} x
                <x-link-secondary href="{{ route('products.show', $commissionProduct->product->formatName()) }}">
                    {{ $commissionProduct->product->name }}
                </x-link-secondary>
            </li>
            <li class="justify-end">
                <p class="font-bold">
                    {{ $commissionProduct->formatPrice() }}
                </p>
            </li>
        </ul>
    @endforeach
</section>
