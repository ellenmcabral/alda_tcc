<button {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center justify-center px-4 py-2 bg-danger-dark border border-transparent rounded-lg font-bold text-white uppercase hover:bg-red-600 transition duration-300']) }}>
    {{ $slot }}
</button>
