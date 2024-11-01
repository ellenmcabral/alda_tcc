@props(['link', 'image'])

<li {{ $attributes->merge(['class' => 'flex justify-between items-center']) }}>
    <div class="flex items-center">
        @isset($image)
            <a class="hidden sm:inline-flex" href="{{ $link }}">
                <x-image class="mr-6 max-w-16"
                         src="/img/products/{{ $image }}" />
            </a>
        @endisset

        @isset($quantity)
            <p class="w-12">
                {{ $quantity }}
            </p>
        @endisset

        <x-link class="line-clamp-1 w-40 sm:w-fit lg:line-clamp-none" href="{{ $link }}">
            {{ $product }}
        </x-link>
    </div>

    <div class="text-right w-32">
        <p class="text-gray-regular hidden md:block">
            {{ $price }}
        </p>

        @isset($subtotal)
            <p class="font-bold">
                {{ $subtotal }}
            </p>
        @endisset
    </div>
</li>
