<section class="grid gap-4">
    <header class="flex items-center gap-2">
        <i class="fa-solid fa-bag-shopping"></i>
        <x-text-subheading>
            Resumo de Itens
        </x-text-subheading>
    </header>

    <ul class="grid gap-8">
        @foreach($commissionProducts as $commissionProduct)
            <x-list-item :link="route('products.show', $commissionProduct->product->id)"
                         :image="$commissionProduct->product->image">

                <x-slot:quantity>
                    {{ $commissionProduct->quantity }} x
                </x-slot:quantity>

                <x-slot:product>
                    {{ $commissionProduct->product->name }}
                </x-slot:product>

                <x-slot:price>
                    {{ $commissionProduct->formatPrice() }}
                </x-slot:price>

                <x-slot:subtotal>
                    R$ {{ number_format($commissionProduct->total, 2, ',', '.') }}
                </x-slot:subtotal>
            </x-list-item>
        @endforeach
    </ul>
</section>
