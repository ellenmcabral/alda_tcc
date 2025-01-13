<x-dashboard-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('shop.customization') }}
    </x-slot:breadcrumbs>

    <div class="grid gap-8 w-full h-fit md:w-2/3">
        <x-form action="{{ route('artisan.shop.customization.update') }}"
                enctype="multipart/form-data">
            @method('patch')

            <div class="flex gap-4 flex-col xl:flex-row">
                <x-image class="w-40"
                         src="{{ Auth::user()->shop->getImagePath() }}"
                         alt="Imagem de {{ $shop->name }}" />

                <div class="h-fit">
                    <x-input-label for="image" :value="'Imagem'" />
                    <input id="image"
                           class="w-full mt-2 file:rounded-lg rounded-lg cursor-pointer focus:outline-none"
                           type="file"
                           name="image"
                           :value="old('image')"
                           autofocus
                           autocomplete="image" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
            </div>

            <div>
                <x-input-label for="description" :value="'Descrição'" />
                <x-input-textarea class="h-40"
                                  name="description"
                                  placeholder="Digite a descrição">{{ $shop->description ?? $shop->description }}</x-input-textarea>
            </div>

            <x-slot:cancelButton>
                <x-button-outlined href="{{ route('artisan.shop.edit') }}"
                                   class="w-full" :color="'gray'">
                    Cancelar
                </x-button-outlined>
            </x-slot:cancelButton>

            <x-slot:button>
                Salvar
            </x-slot:button>
        </x-form>
    </div>
</x-dashboard-layout>
