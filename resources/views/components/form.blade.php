@props(['method' => 'POST'])

<form {{ $attributes->merge([
        'class' => 'grid gap-10 w-full',
        'method' => $method,
        ]) }}>
    @csrf

    {{ $slot }}
</form>
