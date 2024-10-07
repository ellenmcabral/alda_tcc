<a {{
    $attributes->merge([
        'class' => 'text-secondary-regular font-bold text-lg hover:text-secondary-dark transition ease-in-out duration-300'
        ])
    }}>

    {{ $slot }}
</a>
