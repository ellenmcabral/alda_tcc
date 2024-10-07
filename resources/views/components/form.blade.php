@props(['width' => 'md'])

@php
$width = [
    'full' => 'w-full',
    'md' => 'md:w-1/2',
][$width];
@endphp

<form class="flex flex-col gap-10 {{ $width }}"
      method="POST">
    @csrf

    {{ $slot }}

    <x-button class="self-end w-full md:w-64">
        {{ $button }}
    </x-button>
</form>
