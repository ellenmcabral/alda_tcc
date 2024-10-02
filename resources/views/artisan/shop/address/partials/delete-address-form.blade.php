<x-button-danger class="w-full"
                 x-data=""
                 x-on:click.prevent="$dispatch('open-modal', 'confirm-shop-address-deletion')">
    Excluir Endereço
</x-button-danger>

<x-modal :maxWidth="'sm'"
         name="confirm-shop-address-deletion" focusable>
    <form method="post"
          action="{{ route('artisan.shop.address.remove') }}">
        @csrf
        @method('patch')

        <div class="grid gap-4 p-6">
            <h3 class="text-2xl font-bold text-neutral-black">
                Tem certeza que deseja excluir este endereço?
            </h3>

            <div class="flex justify-between">
                <x-button-outlined :color="'gray'" x-on:click="$dispatch('close')">
                    Cancelar
                </x-button-outlined>

                <x-button-danger>
                    Sim, excluir
                </x-button-danger>
            </div>
        </div>
    </form>
</x-modal>
