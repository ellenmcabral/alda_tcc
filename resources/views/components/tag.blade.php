<a {{ $attributes->merge([
    'class' => 'flex text-gray-dark justify-center items-center px-4 py-2 rounded-xl border border-gray-regular hover:border-accent-regular hover:text-accent-dark transition ease-in-out duration-150'
    ]) }}>
    {{ $slot }}
</a>
