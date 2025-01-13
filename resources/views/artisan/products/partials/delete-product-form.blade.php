<button aria-label="Excluir produto"
   class="cursor-pointer text-gray-regular text-2xl hover:text-gray-dark transition duration-300"
   x-data=""
   x-on:click.prevent="$dispatch('open-modal', 'confirm-product-deletion-{{ $product->id }}')"
>
    <i class="fa-solid fa-trash"></i>
</button>

<x-modal :maxWidth="'sm'"
         name="confirm-product-deletion-{{ $product->id }}"
         :show="$errors->productDeletion->isNotEmpty()" focusable>
    <form class="grid gap-4 p-6 text-left"
          method="post"
          action="{{ route('artisan.products.destroy', $product->id) }}">
        @csrf
        @method('delete')

        <h3 class="text-2xl font-bold text-neutral-black">
            Tem certeza que quer excluir este produto?
        </h3>

        <p class="text-gray-dark">
            O produto "<span class="font-bold">{{ $product->name }}</span>" será excluído permanentemente, junto com qualquer pedido que o possuir.
        </p>

        <x-input-text
            id="password"
            name="password"
            type="password"
            class="w-full"
            placeholder="Digite sua senha para confirmar"
        />

        <x-input-error :messages="$errors->productDeletion->get('password')"/>

        <div class="flex gap-4 mt-4">
            <x-button-outlined :color="'gray'"
                               class="w-full cursor-pointer"
                               x-on:click="$dispatch('close')">
                Cancelar
            </x-button-outlined>

            <x-button-danger class="w-full">
                Sim, excluir
            </x-button-danger>
        </div>
    </form>
</x-modal>
