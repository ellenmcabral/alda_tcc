<form class="h-fit"
      action="{{ route('search') }}"
      method="GET">
    <div class="flex bg-white items-center justify-center py-2 px-4 rounded-xl">
        <select class="p-0 w-24 text-sm lg:w-28 lg:text-base cursor-pointer border-none text-gray-dark focus:ring-transparent"
                name="search_type">
            <option value="Produtos">Produtos</option>
            <option value="Lojas">Lojas</option>
        </select>

        <span class="mr-2 text-gray-regular">|</span>

        <input class="p-0 w-full text-sm placeholder-gray-dark lg:text-base border-none focus:text-accent-darker focus:bg-transparent focus:ring-transparent"
               type="text"
               name="search_text"
               :value="old('search_text')"
               placeholder="Digite a sua pesquisa..." />

        <button class="hover:text-primary-800 transition ease-in-out duration-150">
            <i class="text-gray-dark fa-solid fa-magnifying-glass"></i>
        </button>
    </div>

    <x-input-error class="mt-2" :messages="$errors->get('search_type')" />
</form>
