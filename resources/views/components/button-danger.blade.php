<button {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'uppercase text-lg inline-flex items-center justify-center gap-2 px-4 py-2 bg-danger-dark border border-transparent rounded-lg font-bold text-white hover:opacity-75 transition duration-300']) }}>
    {{ $slot }}
</button>
