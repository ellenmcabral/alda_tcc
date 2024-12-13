@props(['type' => 'white'])

@php

    switch($type) {
        case 'iconSecondary':
            $imgPath = '/img/assets/logo_icon_secondary.png';
            $class = 'w-8';
            break;
        case 'iconWhite':
            $imgPath = '/img/assets/logo_icon_white.png';
            $class = 'w-8';
            break;
        case 'white':
            $imgPath = '/img/assets/logo_white.png';
            $class = 'w-28';
            break;
        case 'secondary':
            $imgPath = '/img/assets/logo.png';
            $class = 'w-28';
            break;
    }

@endphp

<a {{ $attributes->merge([
        'class' => $class,
        ]) }}
   href="@auth {{ route('home') }} @else {{ route('alda') }} @endauth">

    <img src="{{ $imgPath }}"
         alt="Logo do site Alda" />
</a>
