@props(['width' => 'full', 'src'])

<img class="w-{{ $width }} object-cover rounded-lg aspect-square"
     src="{{ $src }}" />
