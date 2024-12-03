<x-dashboard-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('shops.edit', $shop->name) }}
    </x-slot:breadcrumbs>

    <div class="w-full h-fit grid gap-8 md:w-2/3">
        <x-form action="{{ route('admin.shops.update', $shop->id) }}"
                enctype="multipart/form-data">
            @method('patch')

            <div>
                <x-image class="w-40"
                         :src="$shop->getImagePath()"
                         alt="Imagem de {{ $shop->name }}" />
                <x-input-label for="image" :value="'Imagem'" />
                <input id="image"
                       name="image"
                       type="file"
                       :value="old('image', $shop->image)" focusable />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="name" :value="'Nome'" />
                <x-input-text id="name"
                              name="name"
                              type="text"
                              :value="old('name', $shop->name)"
                              placeholder="Digite o nome da loja"
                              required
                              autocomplete="name" autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="url" :value="'URL'" />
                <p class="text-gray-dark">
                    www.site.com/<span class="font-bold">urldaloja</span>
                </p>
                <x-input-text id="url"
                              name="url"
                              type="text"
                              :value="old('url', $shop->url)"
                              placeholder="Digite a url da loja"
                              required
                              autocomplete="url" />
                <x-input-error :messages="$errors->get('url')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description" :value="'Descrição'" />
                <x-input-textarea id="description"
                                  name="description"
                                  placeholder="Digite a descrição" >{{ $shop->description }}</x-input-textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <x-slot:button>
                Salvar
            </x-slot:button>
        </x-form>
    </div>
</x-dashboard-layout>
