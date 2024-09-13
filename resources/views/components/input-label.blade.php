@props(['value'])

<label {{ $attributes->merge(['class' => 'cursor-pointer block font-bold text-gray-dark']) }}>
    {{ $value ?? $slot }}
</label>
