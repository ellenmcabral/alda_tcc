<x-app-layout>
    <div class="flex flex-col gap-8 w-full lg:w-1/2 xl:w-1/3">
        <x-text-heading>
            Criar Loja
        </x-text-heading>

        <img class="w-fit md:w-1/2 self-center" src="/img/assets/shop.png" />

        <x-text-paragraph class="text-lg flex gap-2 p-4 border border-gray-light rounded-lg">
            <i class="mt-2 text-gray-regular fa-solid fa-circle-info"></i>
            <span>
                Ao criar uma loja, você terá acesso ao <span class="font-bold">Painel do Artesão</span>. Você terá acesso à:
            </span>
        </x-text-paragraph>

        <ul class="grid gap-8">
            <li class="flex gap-4 items-center">
                <span class="flex justify-center items-center p-4 rounded-full bg-[#F7EAE9] text-secondary-regular">
                    <i class="text-2xl fa-solid fa-tags"></i>
                </span>
                Criação, edição e remoção de produtos.
            </li>
            <hr/>
            <li class="flex gap-4 items-center">
                <span class="flex justify-center items-center p-4 rounded-full bg-[#F7EAE9] text-secondary-regular">
                    <i class="text-2xl fa-solid fa-list-check"></i>
                </span>
                Uma lista de encomendas da sua loja.
            </li>
            <hr/>
            <li class="flex gap-4 items-center">
                <span class="flex justify-center items-center p-4 rounded-full bg-[#F7EAE9] text-secondary-regular">
                    <i class="text-2xl fa-solid fa-shop"></i>
                </span>
                Aos dados e personalização da sua loja.
            </li>
        </ul>

        <div class="grid gap-2">
            <p class="text-lg font-bold text-secondary-regular">
                Dê o seu primeiro passo com a gente.
            </p>
            <p>
                Sem pressão! As informações da sua loja poderão ser alteradas depois.
            </p>
        </div>

        <x-form action="{{ route('shop.store') }}">
            <div>
                <x-input-label for="name" :value="__('Name')" />
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
                <x-input-label for="url" :value="'Url da loja'" />
                <x-text-paragraph>
                    www.site.com/<span class="font-bold">urldaloja</span>
                </x-text-paragraph>
                <x-input-text id="url"
                              class="w-full"
                              type="text"
                              name="url"
                              :value="old('url')"
                              placeholder="Digite a url da loja"
                              required autocomplete="url" />
                <x-input-error :messages="$errors->get('url')" class="mt-2" />
            </div>


            <x-button class="w-full">
                {{ __('Create') }}
            </x-button>
        </x-form>
    </div>
</x-app-layout>
