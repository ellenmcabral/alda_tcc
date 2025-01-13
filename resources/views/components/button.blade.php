@props(['disabled' => false])

@php
    $color = ($disabled ?? false)
                ? 'bg-gray-regular text-gray-dark'
                : 'text-neutral-white bg-secondary-regular hover:bg-secondary-dark transition duration-300 focus:outline-accent-regular';

    $class = $color . ' text-lg px-4 py-2 rounded-lg font-bold uppercase';
@endphp

<button {{ $attributes->merge([
                'type' => 'submit',
                'class' => $class
        ]) }} {{ $disabled ? 'disabled' : '' }}>
    {{ $slot }}
</button>
