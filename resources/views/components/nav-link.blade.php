@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-neutral-white text-lg font-bold hover:text-gray-light transition ease-in-out duration-300'
            : 'text-neutral-white text-lg hover:text-gray-light transition duration-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
