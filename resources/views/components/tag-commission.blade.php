@props(['status' => 1])

@php

    if($status >= 1 and $status <= 4) {
        $bgColor = 'bg-warning-regular ';
    } elseif($status == 5) {
        $bgColor = 'bg-success-regular ';
    } else {
        $bgColor = 'bg-danger-regular ';
    }

    $class = $bgColor . 'text-sm md:text-base px-3 py-1 w-fit rounded-full text-gray-dark';

@endphp

<p {{ $attributes->merge([
    'class' => $class
]) }}>
    {{ $slot }}
</p>
