<x-dashboard-layout>
    <x-slot name="header">
        {{ Breadcrumbs::render('products.create') }}
    </x-slot>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                Informações do Produto
                            </h2>
                        </header>

                        <form method="POST" action="{{ route('artisan.products.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <x-input-label for="image" :value="'Imagem'" />
                                <x-text-input id="image"
                                              class="block mt-1 w-full"
                                              type="file"
                                              name="image"
                                              :value="old('image')"
                                              required autofocus
                                              autocomplete="image" />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="name" :value="'Nome'" />
                                <x-text-input id="name"
                                              class="block mt-1 w-full"
                                              type="text"
                                              name="name"
                                              :value="old('name')"
                                              required autofocus
                                              autocomplete="name"
                                              placeholder="Digite o nome do produto"/>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="sale_price" :value="'Preço de Venda'" />
                                <x-text-input id="sale_price"
                                              class="block mt-1 w-full"
                                              type="number"
                                              name="sale_price"
                                              :value="old('sale_price')"
                                              required autofocus
                                              autocomplete="sale_price"
                                              placeholder="R$ 0"/>
                                <x-input-error :messages="$errors->get('sale_price')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="description" :value="'Descrição'" />
                                <x-textarea-input id="description"
                                              class="block mt-1 w-full"
                                              name="description"
                                              :value="old('description')"
                                              autofocus
                                              autocomplete="description"
                                              placeholder="Campo opcional">
                                </x-textarea-input>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="categories" :value="'Categoria'"/>
                                <x-select-input id="categories"
                                                name="category_id"
                                                class="block mt-1 w-full">
                                    <option value="" selected>Escolha uma categoria</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->description }}
                                        </option>
                                    @endforeach
                                </x-select-input>
                                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Create') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
