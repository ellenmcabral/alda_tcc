<select {!! $attributes->merge([
    'class' => 'px-4 py-2 cursor-pointer bg-transparent border border-gray-300 rounded-lg focus:border-accent-regular focus:ring-accent-regular'
    ]) !!}>
    {{ $slot }}
</select>
