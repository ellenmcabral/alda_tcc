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
        <x-button class="w-full lg:self-end lg:w-64">
            {{ $button }}
        </x-button>
    @endisset
</form>
