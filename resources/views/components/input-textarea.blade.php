<textarea {!! $attributes->merge([
    'class' => 'w-full px-4 py-2 border border-gray-regular rounded-lg bg-white focus:text-accent-darker focus:border-accent-regular focus:ring-accent-regular'
    ]) !!}>{{ $slot }}</textarea>
