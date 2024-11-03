<div>
    <x-input-label for="images" :value="'Imagens'" />

    <div class="mt-2 grid gap-4 bg-gray-light p-4">
        <div class="flex items-center gap-4">
            <label for="images" class="cursor-pointer text-black/75 w-12 h-12 flex items-center justify-center border-accent-regular border-2 rounded-full">
                <i class="fa-solid fa-plus"></i>
            </label>

            <input id="images"
                   class="hidden"
                   type="file"
                   name="images[]"
                   autofocus
                   wire:model="images" multiple />

{{--        <input id="image" class="hidden" type="file" name="image" wire:model.live="image" />--}}

            <p class="text-gray-dark">
                Selecione até 5 imagens
            </p>

            <p class="text-gray-dark" wire:loading>
                Carregando...
            </p>
        </div>

        @if($images)
            <div class="grid gap-2 grid-cols-2 sm:grid-cols-4">
                @foreach($images as $key => $image)
                    <div class="relative">
                        <x-image class="w-full" src="{{ $image->temporaryUrl() }}" />

                        <button class="absolute top-1 right-1 bg-white/50 text-black/75 rounded-full w-8 h-8"
                                type="button"
                                wire:click="remove({{$key}})">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                @endforeach

            </div>
        @endisset
    </div>

    @isset($error)
        <x-input-error class="mt-2" :messages="$error" />
    @endisset

    <x-input-error class="mt-2" :messages="$errors->get('images')" />
</div>
