@props(['src'])

<img {{ $attributes->merge([
    'class' => 'object-cover rounded-lg aspect-square'
]) }}
     src="{{ $src }}" />
