@props(['color' => 'accent'])

@php
    switch($color) {
        case 'secondary':
            $color = 'bg-secondary-regular hover:bg-secondary-dark text-neutral-white';
            break;
        case 'accent':
            $color = 'bg-accent-regular hover:bg-accent-dark text-neutral-black';
            break;
        case 'accent-darker':
            $color = 'bg-accent-darker hover:bg-[#00663C] text-neutral-white';
            break;
        case 'white':
            $color = 'bg-neutral-white hover:bg-gray-light text-secondary-regular';
            break;
    }

    $classes = $color . ' uppercase flex justify-center items-center gap-2 font-bold rounded-lg py-2 px-4 transition duration-300'
@endphp

<a {{ $attributes->merge([
        'class' => $classes,
        ]) }}>

    {{ $slot }}
</a>
