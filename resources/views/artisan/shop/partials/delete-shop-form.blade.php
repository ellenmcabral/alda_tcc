<x-button-danger
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-shop-deletion')">
    Deletar Loja
</x-button-danger>

<x-modal :maxWidth="'sm'"
         name="confirm-shop-deletion"
         :show="$errors->shopDeletion->isNotEmpty()" focusable>
    <form class="grid gap-4 p-6"
          method="post"
          action="{{ route('artisan.shop.destroy') }}">
        @csrf
        @method('delete')

        <h3 class="text-2xl font-bold text-neutral-black">
            Tem certeza que quer excluir sua loja?
        </h3>

        <p class="text-gray-dark">
            Todos os seus produtos e encomendas serão excluídos permanentemente.
        </p>

        <x-input-text
            id="password"
            name="password"
            type="password"
            class="w-full"
            placeholder="Digite sua senha para confirmar" />

        <x-input-error :messages="$errors->shopDeletion->get('password')" />

        <div class="flex gap-4">
            <x-button-outlined :color="'gray'"
                               class="w-full"
                               x-on:click="$dispatch('close')">
                Cancelar
            </x-button-outlined>

            <x-button-danger class="w-full">
                Sim, excluir
            </x-button-danger>
        </div>
    </form>
</x-modal>
