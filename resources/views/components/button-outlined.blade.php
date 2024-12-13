@props(['color' => 'white'])

@php
    switch($color) {
      case 'white':
          $color = 'border-neutral-white text-neutral-white';
          break;
      case 'gray':
          $color = 'border-gray-dark text-gray-dark';
          break;
      case 'secondary':
          $color = 'border-secondary-regular text-secondary-regular';
          break;
    };

    $class = 'cursor-pointer text-center uppercase font-bold rounded-lg py-2 px-4 border border-2 hover:bg-gray-light hover:bg-opacity-10 transition duration-300 ' . $color;

@endphp

<a {{ $attributes->merge([
        'class' => $class,
        ]) }}>

    {{ $slot }}
</a>
