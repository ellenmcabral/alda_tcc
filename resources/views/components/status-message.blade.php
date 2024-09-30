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

    $classes = 'w-full flex justify-between items-start gap-4 absolute top-5 p-4 border border-1 rounded text-neutral-black ' . $type;

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
