<x-dashboard-layout>
    <div class="grid gap-8 w-full h-fit lg:w-1/2 xl:w-1/3">
        <div class="hidden sm:inline-flex">
            {{ Breadcrumbs::render('shop.information') }}
        </div>

        <x-text-heading>
            Informações da Loja
        </x-text-heading>

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
                <p class="text-gray-dark">
                    www.site.com/<span class="font-bold">urldaloja</span>
                </p>
                <x-input-text id="url"
                              class="w-full"
                              type="text"
                              name="url"
                              :value="old('url', $shop->url)"
                              required autofocus autocomplete="url" />
                <x-input-error :messages="$errors->get('url')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-button class="w-full">
                    {{ __('Save') }}
                </x-button>
            </div>
        </x-form>
    </div>
</x-dashboard-layout>
