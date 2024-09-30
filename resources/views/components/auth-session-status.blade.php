@props(['status', 'type'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'p-4 rounded font-medium text-sm bg-green-400']) }}>
        {{ $status }}
    </div>
@endif
