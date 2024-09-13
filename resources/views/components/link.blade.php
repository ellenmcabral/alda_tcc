<a {{
    $attributes->merge([
        'class' => 'underline text-secondary-regular font-bold text-lg hover:text-secondary-dark transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-regular'
        ])
    }}>

    {{ $slot }}
</a>
