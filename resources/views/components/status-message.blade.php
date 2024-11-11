@props(['status', 'type' => 'success', 'static' => false])

@php

switch($type) {
    case 'success':
        $type = 'border-success-dark bg-success-regular';
        break;
    case 'warning':
        $type = 'border-warning-dark bg-warning-regular';
        break;
    case 'danger':
        $type = 'border-danger-dark bg-danger-regular';
        break;
}

    $classes = 'absolute z-50 w-full lg:w-2/3 top-0 lg:top-6 lg:py-4 flex justify-between items-start py-8 px-4 border border-1 rounded text-neutral-black ' . $type;

@endphp

@if($static)
    <div x-data="{ show: true }"
       x-show="show"
       x-transition
        {{ $attributes->merge(['class' => $classes]) }}>
        <p>
            {{ $status }}
        </p>
        <div @click="open = ! open">
            <i class="fa-solid fa-x"></i>
        </div>
    </div>
@else
    <div x-data="{ show: true }"
       x-show="show"
       x-transition
       x-init="setTimeout(() => show = false, 4000)"
        {{ $attributes->merge(['class' => $classes]) }}>
        <p>
            {{ $status }}
        </p>
        <button class="text-neutral-black" @click="show = ! show">
            <i class="fa-solid fa-x"></i>
        </button>
    </div>
@endif
