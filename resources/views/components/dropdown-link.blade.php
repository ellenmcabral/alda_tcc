@props(['active' => false, 'icon' => false, 'color' => 'gray'])

@php

    switch($color) {
        case 'gray':
            $colors = 'text-gray-dark hover:text-neutral-black ';
            break;
        case 'secondary':
            $colors = 'text-secondary-regular hover:text-secondary-dark ';
            break;
    }

    $class = $colors . 'flex items-center gap-2 w-full p-6 lg:py-5 hover:bg-gray-100 transition duration-300';
@endphp

<a {{ $attributes->merge(['class' => $class]) }}>
    <i class="fa-solid @if($active) text-accent-regular @else text-gray-regular @endif @if($color == 'secondary') text-secondary-regular @endif {{ $active }} {{ $icon }}"></i>
    {{ $slot }}
</a>
