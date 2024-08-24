<x-app-layout>
    <x-slot name="heading">
        Ativar Loja
    </x-slot>
    <p class="text-sm text-gray-600">
        Preencha o seu CPF ou CNPJ para ter acesso ao Painel de Controle do Artesão.
    </p>
    <form class="grid gap-8" x-data="{ option : '{{ old('option') ? old('option') : 'cpf' }}' }"
          method="post"
          action="{{ route('shops.activate', $shop->id) }}">

        @csrf @method('patch')

        <div class="flex items-center">
            <x-text-input type="radio"
                          id="option-cpf"
                          name="option"
                          value="cpf"
                          class="ring-2 ring-gray-400 focus:outline-none accent-primary-700 focus:accent-primary-700 focus:outline-primary-700"
                          x-model="option"
            />
            <x-input-label for="option-cpf"
                           class="ml-2"
                           :value="'CPF'" />
        </div>
        <div class="mt-2 flex items-center">
            <x-text-input type="radio"
                          id="option-cnpj"
                          name="option"
                          value="cnpj"
                          class="ring-2 ring-gray-400 focus:outline-none accent-primary-700 focus:accent-primary-700 focus:outline-primary-700"
                          x-model="option"
            />
            <x-input-label for="option-cnpj"
                           class="ml-2"
                           :value="'CNPJ'"/>
        </div>

        <template x-if="option == 'cpf'" >
            <div x-data>
                <x-text-input class="w-full"
                              type="text"
                              name="cpf"
                              :value="old('cpf')"
                              x-mask="999.999.999-99"
                              placeholder="000.000.000-00"/>
                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
            </div>
        </template>
        <template x-if="option == 'cnpj'">
            <div x-data>
                <x-text-input class="w-full"
                              type="text"
                              name="cnpj"
                              :value="old('cnpj')"
                              x-mask="99.999.999/9999-99"
                              placeholder="00.000.000/0000-00"/>
                <x-input-error :messages="$errors->get('cnpj')" class="mt-2" />
            </div>
        </template>

        <x-primary-button>
            Enviar
        </x-primary-button>
    </form>
</x-app-layout>
