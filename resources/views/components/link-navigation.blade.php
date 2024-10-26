@props(['active' => false, 'color' => 'white'])

@php
    if($active) {
        $active = 'font-bold ';
    }

    switch($color) {
        case 'white':
            $color = 'text-neutral-white hover:text-gray-light ';
            break;
        case 'secondary':
            $color = 'text-secondary-regular hover:text-secondary-dark ';
            break;
    }

    $class = $active . $color . ' text-lg transition duration-300';

@endphp

<a {{ $attributes->merge([
        'class' => $class
    ]) }}>

    {{ $slot }}
</a>
