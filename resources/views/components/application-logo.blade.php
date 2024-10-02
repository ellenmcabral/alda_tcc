@props(['color' => 'white'])

@php
    switch($color) {
        case 'white':
            $color = 'text-neutral-white ';
            break;
        case 'secondary':
            $color = 'text-secondary-regular ';
            break;
    }

    $class = $color . 'z-40 font-bold text-4xl';

@endphp

<a class="{{ $class }}"
   href="@auth {{ route('home') }} @else {{ route('alda') }} @endauth">
    Alda
</a>
