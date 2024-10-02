<select {!! $attributes->merge([
    'class' => 'w-full px-4 py-2 cursor-pointer border border-gray-regular rounded-lg focus:border-accent-regular focus:ring-accent-regular'
    ]) !!}>
    {{ $slot }}
</select>
