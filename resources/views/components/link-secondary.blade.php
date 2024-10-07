<a {{
    $attributes->merge([
        'class' => 'text-lg text-gray-dark hover:text-neutral-black transition ease-in-out duration-300'
        ])
    }}>

    {{ $slot }}
</a>
