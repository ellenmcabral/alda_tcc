@props(['width' => 'lg'])

@php
$width = [
    'full' => 'w-full',
    'lg' => 'lg:w-1/2',
][$width];

$class = $width . ' flex flex-col gap-10'
@endphp

<form {{ $attributes->merge([
    'class' => $class,
    'method' => 'post',
    ]) }}>
    @csrf

    {{ $slot }}

    @isset($button)
        <div class="flex gap-2 lg:gap-8 justify-between">
            {{ $cancelButton }}
            <x-button class="w-full">
                {{ $button }}
            </x-button>
        </div>

    @endisset
</form>
