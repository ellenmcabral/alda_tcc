<h1 {{ $attributes->merge([
        'class' => 'font-extrabold text-4xl text-neutral-black'
        ]) }}>

    {{ $slot }}
</h1>
