@props(['color' => 'accent'])

@php
    switch($color) {
        case 'secondary':
            $color = 'bg-secondary-regular hover:bg-secondary-dark ';
            break;
        case 'accent':
            $color = 'bg-accent-darker hover:bg-[#00663C] ';
            break;
    }

    $classes = $color . 'flex justify-center items-center gap-2 font-bold rounded-lg py-2 px-4 text-neutral-white transition duration-300'
@endphp

<a {{ $attributes->merge([
        'class' => $classes,
        ]) }}>

    {{ $slot }}
</a>
