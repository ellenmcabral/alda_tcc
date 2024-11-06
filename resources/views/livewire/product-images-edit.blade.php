<div>
    <x-input-label for="images" :value="'Imagens'" />

    <div class="mt-2 grid gap-4 bg-gray-light p-4">
        <div class="flex flex-col lg:flex-row lg:items-center gap-4">
            <div class="flex items-center gap-4">
                <label for="image"
                       class="cursor-pointer text-black/75 w-12 h-12 flex items-center justify-center border-accent-regular border-2 rounded-full">
                    <i class="fa-solid fa-plus"></i>
                </label>

                <input id="images"
                       class="hidden"
                       type="file"
                       name="images[]"
                       wire:model="images" multiple />

                <input id="image"
                       class="hidden"
                       type="file"
                       name="image"
                       wire:model="image" />

                <p class="text-gray-dark">
                    Adicione uma imagem
                </p>
            </div>

            <p class="text-gray-dark" wire:loading>
                Carregando...
            </p>
        </div>

        @isset($productImages)
            <div class="grid gap-2 grid-cols-2 sm:grid-cols-3">
                @foreach($productImages as $key => $productImage)
                    <div class="relative">
                        <x-input-radio id="is_default_{{$key}}"
                                       type="radio"
                                       class="hidden peer"
                                       name="is_default"
                                       :value="$key"
                                       :checked="$productImage->is_default" />

                        <label for="is_default_{{$key}}" wire:click="turnDefault({{$productImage->id}})"
                               class="cursor-pointer peer-checked:block peer-checked:border-accent-regular peer-checked:border-2 peer-checked:rounded-lg">
                            <x-image class="w-full"
                                     src="{{ $productImage->getImagePath() }}" />
                        </label>

                        <p class="peer-checked:flex hidden gap-2 absolute bottom-2 left-2 text-neutral-black/75 bg-neutral-white/75 py-1 px-2 rounded-lg peer-checked:text-neutral-black peer-checked:bg-accent-regular">
                            <i class="fa-solid fa-circle-check mt-1"></i> Principal
                        </p>

                        <label for="is_default_{{$key}}" wire:click="turnDefault({{$productImage->id}})"
                               class="cursor-pointer peer-checked:hidden flex justify-center items-center gap-2 absolute bottom-2 left-2 text-neutral-black/75 bg-neutral-white/75 h-8 w-8 rounded-full">
                            <i class="fa-solid fa-check"></i>
                        </label>

                        <button class="absolute top-2 right-2 bg-neutral-white/50 text-neutral-black/75 rounded-full w-8 h-8"
                                type="button"
                                wire:click="delete({{$productImage->id}},{{$key}})">
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
