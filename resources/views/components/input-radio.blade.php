@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' => 'cursor-pointer focus:ring-accent-regular checked:bg-accent-dark checked:focus:bg-accent-dark'
    ]) !!}>
