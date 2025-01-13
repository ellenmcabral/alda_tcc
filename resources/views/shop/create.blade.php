<x-app-layout>
    <x-slot:heading>
        Criar Loja
    </x-slot:heading>

    <div class="flex flex-col gap-8 w-full h-fit md:w-1/2 xl:w-1/3">
        <x-text-subheading class="mt-4 text-secondary-regular">
            Dê o seu primeiro passo na Alda.
        </x-text-subheading>

        <section class="flex gap-2 p-4 border border-gray-light rounded-lg w-fit">
            <i class="mt-1 text-gray-regular fa-solid fa-circle-info"></i>
            <x-text class="text-gray-dark">
                Ao criar uma loja, você terá acesso ao <span class="font-bold">Painel do Artesão</span>.
            </x-text>
        </section>

        <ul class="grid gap-8">
            <li class="flex gap-4 items-center">
                <span class="w-16 h-16 flex justify-center items-center p-4 rounded-full bg-[#F7EAE9] text-secondary-regular">
                    <i class="text-2xl fa-solid fa-tags"></i>
                </span>
                Crie, edite e remova seus produtos.
            </li>

            <li class="flex gap-4 items-center">
                <span class="w-16 h-16 flex justify-center items-center p-4 rounded-full bg-[#F7EAE9] text-secondary-regular">
                    <i class="text-2xl fa-solid fa-list-check"></i>
                </span>
                Veja uma lista de encomendas da sua loja.
            </li>

            <li class="flex gap-4 items-center">
                <span class="w-16 h-16 flex justify-center items-center p-4 rounded-full bg-[#F7EAE9] text-secondary-regular">
                    <i class="text-2xl fa-solid fa-shop"></i>
                </span>
                Edite e personalize o perfil da sua loja.
            </li>
        </ul>

        <x-form :width="'full'"
                :action="route('shop.store')">
            <div>
                <x-input-label for="name" :value="'Nome '" />
                <x-input-text id="name"
                              class="w-full"
                              type="text"
                              name="name"
                              :value="old('name')"
                              placeholder="Digite o nome da loja"
                              required autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="url" :value="'URL'" />
                <x-text class="text-gray-dark">
                    https://alda.com/loja/<span class="font-bold">urldaloja</span>
                </x-text>
                <x-input-text id="url"
                              class="w-full"
                              type="text"
                              name="url"
                              :value="old('url')"
                              placeholder="Digite a url da loja"
                              required autocomplete="url" />
                <x-input-error :messages="$errors->get('url')" class="mt-2" />
            </div>

            <x-slot:cancelButton>
                <x-button-outlined href="{{ route('home') }}"
                                   class="w-full" :color="'gray'">
                    Cancelar
                </x-button-outlined>
            </x-slot:cancelButton>

            <x-slot:button>
                {{ __('Create') }}
            </x-slot:button>
        </x-form>
    </div>
</x-app-layout>
