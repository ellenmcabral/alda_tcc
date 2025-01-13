<x-dashboard-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('shop.information') }}
    </x-slot:breadcrumbs>

    <div class="grid gap-8 w-full h-fit md:w-2/3">
        <x-form action="{{ route('artisan.shop.information.update', $shop->id) }}">
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-input-text id="name"
                              class="w-full"
                              type="text"
                              name="name"
                              :value="old('name', $shop->name)"
                              required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="url" :value="'URL'" />
                <p class="text-sm text-gray-dark">
                    http://alda-tcc-d1ff4d1fabe2.herokuapp.com/loja/<span class="font-bold">urldaloja</span>
                </p>
                <x-input-text id="url"
                              class="w-full"
                              type="text"
                              name="url"
                              :value="old('url', $shop->url)"
                              required autofocus autocomplete="url" />
                <x-input-error :messages="$errors->get('url')" class="mt-2" />
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
