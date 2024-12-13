<x-app-layout>
    <x-slot:heading>
        Ativar Loja
    </x-slot:heading>

    <div class="flex flex-col gap-8 w-full h-fit md:w-1/2 xl:w-1/3">
        <x-image class="w-48 self-center"
                 src="/img/assets/cross-stitch.png" />

        <x-text class="text-gray-dark">
            Preencha o seu CPF ou CNPJ para ter acesso ao <span class="font-bold">Painel de Controle do Artesão</span>.
        </x-text>

        <form class="flex flex-col gap-10 w-full"
              method="post"
              x-data="{ option : '{{ old('option') ? old('option') : 'cpf' }}' }"
              action="{{ route('shop.activate.update') }}">
            @csrf
            @method('patch')

            <div class="flex items-center">
                <x-input-radio type="radio"
                              id="option-cpf"
                              name="option"
                              value="cpf"
                              x-model="option" />
                <x-input-label for="option-cpf"
                               class="ml-2"
                               :value="'CPF'" />
            </div>

            <div class="flex items-center">
                <x-input-radio type="radio"
                              id="option-cnpj"
                              name="option"
                              value="cnpj"
                              x-model="option" />
                <x-input-label for="option-cnpj"
                               class="ml-2"
                               :value="'CNPJ'" />
            </div>

            <template x-if="option == 'cpf'" >
                <div x-data>
                    <x-input-text class="w-full"
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
                    <x-input-text class="w-full"
                                  type="text"
                                  name="cnpj"
                                  :value="old('cnpj')"
                                  x-mask="99.999.999/9999-99"
                                  placeholder="00.000.000/0000-00"/>
                    <x-input-error :messages="$errors->get('cnpj')" class="mt-2" />
                </div>
            </template>

            <x-button class="w-full md:w-64 md:self-end">
                Enviar
            </x-button>
        </form>
    </div>
</x-app-layout>
