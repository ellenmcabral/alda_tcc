<a {{
    $attributes->merge([
        'class' => 'text-lg text-gray-dark hover:text-neutral-black underline transition duration-300'
        ])
    }}>

    {{ $slot }}
</a>
