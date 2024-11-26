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

    $class = $color . 'z-40 w-12 aspect-square hidden sm:flex';

@endphp

<a class="{{ $class }}"
   href="@auth {{ route('home') }} @else {{ route('alda') }} @endauth">
    <img src="/img/assets/logo.png" alt="Logo do site" />
</a>
