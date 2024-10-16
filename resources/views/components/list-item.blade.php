@props(['link', 'image'])

<li {{ $attributes->merge(['class' => 'flex justify-between items-center']) }}>
    <div class="w-full flex items-center gap-4 md:w-1/2">
        @isset($image)
            <a class="hidden sm:block" href="{{ $link }}">
                <x-image class="w-16"
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
