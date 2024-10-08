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

    @isset($button)
        <x-button class="w-full md:self-end md:w-64">
            {{ $button }}
        </x-button>
    @endisset
</form>
