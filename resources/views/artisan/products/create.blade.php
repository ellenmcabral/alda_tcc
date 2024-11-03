<x-dashboard-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('products.create') }}
    </x-slot:breadcrumbs>

    <div class="w-full h-fit grid gap-8 md:w-2/3">
        <x-form action="{{ route('artisan.products.store') }}"
                enctype="multipart/form-data"
                x-data="{ option : '{{ old('option') ? old('option') : 'stock' }}' }" >

            <livewire:product-images />

            <div class="flex gap-6">
                <div class="w-full">
                    <x-input-label for="name" :value="'Nome'" />
                    <x-input-text id="name"
                                  type="text"
                                  name="name"
                                  :value="isset($product) ? $product->name : old('name')"
                                  autofocus autocomplete="name"
                                  placeholder="Digite o nome do produto"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="w-1/3">
                    <x-input-label for="sale_price" :value="'Preço'" />
                    <x-input-number id="sale_price"
                                    type="number" class="w-full mt-2"
                                    min="1"
                                    step="any"
                                    name="sale_price"
                                    :value="isset($product) ? $product->sale_price : old('sale_price')"
                                    autofocus autocomplete="sale_price"
                                    placeholder="R$ 0"/>
                    <x-input-error :messages="$errors->get('sale_price')" class="mt-2" />
                </div>
            </div>

            <div class="flex gap-4 flex-col md:flex-row md:items-center md:gap-8 md:h-10">
                <div class="flex items-center gap-4">
                    <x-input-radio type="radio"
                                   id="option_stock"
                                   name="option"
                                   value="stock"
                                   x-model="option" />
                    <x-input-label for="option_stock"
                                   :value="'Em estoque'" />
                </div>

                <template x-if="option == 'stock'">
                    <div x-data>
                        <div class="flex items-center gap-2">
                            <x-input-number type="number"
                                            class="w-16"
                                            id="stock"
                                            min="1"
                                            name="stock"
                                            :value="old('stock')"
                                            placeholder="0" />
                            <span class="text-gray-dark">unidades</span>
                        </div>

                        <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                    </div>
                </template>
            </div>

            <div class="flex gap-4 flex-col md:flex-row md:items-center md:gap-8 md:h-10">
                <div class="flex items-center gap-4">
                    <x-input-radio type="radio"
                                   id="option_deadline"
                                   name="option"
                                   value="deadline"
                                   x-model="option" />
                    <x-input-label for="option_deadline"
                                   :value="'Sob encomenda'" />
                </div>

                <template x-if="option == 'deadline'">
                    <div x-data>
                        <div class="flex items-center gap-2">
                            <x-input-number type="number"
                                            class="w-16"
                                            id="deadline"
                                            min="1"
                                            name="deadline"
                                            :value="old('deadline')"
                                            placeholder="0" />
                            <span class="text-gray-dark">dias úteis</span>
                        </div>

                        <x-input-error class="mt-2" :messages="$errors->get('deadline')" />
                    </div>
                </template>
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

            <x-button class="md:w-1/3 md:self-end">
                Salvar
            </x-button>
        </x-form>

    </div>
</x-dashboard-layout>
