@props(['link', 'image'])

<li {{ $attributes->merge(['class' => 'flex justify-between items-center']) }}>
    <div class="flex items-center">
        @isset($image)
            <a class="hidden sm:inline-flex" href="{{ $link }}">
                <x-image class="mr-6 max-w-16"
                         src="/storage/img/products/{{ $image }}" />
            </a>
        @endisset

        @isset($quantity)
            <x-text class="w-10">
                {{ $quantity }}
            </x-text>
        @endisset

        <x-link class="line-clamp-1 sm:w-fit" href="{{ $link }}">
            {{ $product }}
        </x-link>
    </div>

    <div class="text-right w-32">
        <x-text class="text-gray-regular hidden md:block">
            {{ $price }}
        </x-text>

        @isset($subtotal)
            <x-text class="font-bold">
                {{ $subtotal }}
            </x-text>
        @endisset
    </div>
</li>
