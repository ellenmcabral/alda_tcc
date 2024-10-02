@props(['disabled' => false])

@php
    $classes = ($disabled ?? false)
                ? 'px-4 py-2 rounded-lg font-bold uppercase bg-gray-regular text-gray-dark'
                : 'px-4 py-2 rounded-lg font-bold uppercase focus:outline-accent-regular text-neutral-white bg-secondary-regular hover:bg-secondary-dark transition duration-300';
@endphp

<button {{ $attributes->merge([
                'type' => 'submit',
                'class' => $classes
        ]) }} {{ $disabled ? 'disabled' : '' }}>
    {{ $slot }}
</button>
