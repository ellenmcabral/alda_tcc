<x-app-layout>
    <x-slot name="heading">
        Criar Loja
    </x-slot>
    <p class="text-sm text-gray-600">
        Dê o seu primeiro passo com a gente. As informações da sua loja poderão ser alteradas depois.
    </p>

    <form class="grid gap-8" method="POST" action="{{ route('shop.store') }}">
        @csrf
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name"
                          class="w-full"
                          type="text"
                          name="name"
                          :value="old('name')"
                          placeholder="Digite o nome da loja"
                          required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>

            <x-input-label for="url" :value="'Url da loja'" />
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                www.site.com/urldaloja
            </p>
            <x-text-input id="url"
                          class="w-full"
                          type="text"
                          name="url"
                          :value="old('url')"
                          placeholder="Digite a url da loja"
                          required autofocus autocomplete="url" />
            <x-input-error :messages="$errors->get('url')" class="mt-2" />
        </div>


        <x-primary-button class="w-full">
            {{ __('Create') }}
        </x-primary-button>
    </form>
</x-app-layout>
