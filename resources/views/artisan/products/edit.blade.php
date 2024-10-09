<x-dashboard-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('products.edit', $product->name) }}
    </x-slot:breadcrumbs>

    <div class="w-full h-fit grid gap-8 md:w-2/3">
        <x-form action="{{ route('artisan.products.update', $product->id) }}"
                enctype="multipart/form-data">

            @method('patch')

            <x-image :src="$product->getImagePath()"
                     alt="Imagem de {{ $product->name }}"/>

            <div>
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

            <div class="flex gap-6">
                <div class="w-full">
                    <x-input-label for="name" :value="'Nome'" />
                    <x-input-text id="name"
                                  type="text"
                                  name="name"
                                  :value="isset($product) ? $product->name : old('name')"
                                  required autofocus
                                  autocomplete="name"
                                  placeholder="Digite o nome do produto"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="w-1/3">
                    <x-input-label for="sale_price" :value="'Preço'" />
                    <x-input-text id="sale_price"
                                  type="number"
                                  min="1"
                                  step="any"
                                  name="sale_price"
                                  :value="isset($product) ? $product->sale_price : old('sale_price')"
                                  required autofocus
                                  autocomplete="sale_price"
                                  placeholder="R$ 0"/>
                    <x-input-error :messages="$errors->get('sale_price')" class="mt-2" />
                </div>
            </div>

            <div>
                <x-input-label for="description" :value="'Descrição (opcional)'" />
                <x-input-textarea id="description"
                                  class="mt-2 h-32"
                                  name="description"
                                  placeholder="Digite a descrição">@isset($product->description) {{ $product->description }} @endisset</x-input-textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="categories" :value="'Categoria'"/>
                <x-input-select id="categories"
                                name="category_id"
                                class="block mt-1 w-full">
                    <option value="">Escolha uma categoria</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ isset($product) ? $product->category_id == $category->id ? 'selected' : '' : old('category_id') }}>
                            {{ $category->description }}
                        </option>
                    @endforeach
                </x-input-select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <x-slot:button>
                Salvar
            </x-slot:button>
        </x-form>
    </div>
</x-dashboard-layout>
