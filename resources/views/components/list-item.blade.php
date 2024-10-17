@props(['link', 'image'])

<li {{ $attributes->merge(['class' => 'flex justify-between items-center']) }}>
    <div class="flex items-center gap-4 lg:w-full">
        @isset($image)
            <a class="hidden sm:inline-flex" href="{{ $link }}">
                <x-image class="max-w-16"
                         src="/img/products/{{ $image }}" />
            </a>
        @endisset

        @isset($quantity)
            <p class="w-12">
                {{ $quantity }}
            </p>
        @endisset

        <x-link-secondary class="line-clamp-1" href="{{ $link }}">
            {{ $product }}
        </x-link-secondary>
    </div>

    <div class="text-right w-1/2">
        <p class="text-gray-regular">
            {{ $price }}
        </p>

        @isset($subtotal)
            <p class="font-bold text-accent-dark">
                {{ $subtotal }}
            </p>
        @endisset
    </div>
</li>
