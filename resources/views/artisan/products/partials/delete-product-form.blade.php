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
          action="{{ route('artisan.products.delete', $product->id) }}">
        @csrf
        @method('patch')

        <x-text-subheading>
            Tem certeza que quer excluir este produto?
        </x-text-subheading>

        <x-text class="text-gray-dark">
            O produto "<span class="font-bold">{{ $product->name }}</span>" será marcado como excluído.
        </x-text>

        <x-text class="text-gray-dark">
            Você poderá ativá-lo novamente na página de Produtos Excluídos.
        </x-text>

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
