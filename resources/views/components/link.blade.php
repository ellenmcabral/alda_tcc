<a {{
    $attributes->merge([
        'class' => 'text-secondary-regular font-bold text-lg hover:underline hover:text-secondary-dark transition duration-300'
        ])
    }}>

    {{ $slot }}
</a>
