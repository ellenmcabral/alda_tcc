<x-dashboard-layout>
    <x-slot name="heading">
        Informações da Loja
    </x-slot>
    <x-slot name="breadcrumbs">
        {{ Breadcrumbs::render('shop.information') }}
    </x-slot>

    <form class="grid gap-8"
          method="POST"
          action="{{ route('artisan.shop.information.update', $shop->id) }}">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $shop->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>

            <x-input-label for="url" :value="'Url da loja'" />
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                www.site.com/urldaloja
            </p>
            <x-text-input id="url" class="block mt-1 w-full" type="text" name="url" :value="old('url', $shop->url)" required autofocus autocomplete="url" />
            <x-input-error :messages="$errors->get('url')" class="mt-2" />
        </div>

        <div class="grid gap-4">
            <x-primary-button class="w-full">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>

</x-dashboard-layout>
