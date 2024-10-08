<article {{ $attributes->merge([
    'class' => 'flex flex-col justify-between gap-4 bg-white rounded-lg p-4 shadow-md'
    ]) }}>
    {{ $slot }}

</article>
