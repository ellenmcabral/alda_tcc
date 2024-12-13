<x-button-danger
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-shop-deletion')">
    EXCLUIR LOJA
</x-button-danger>

<x-modal-delete :name="'confirm-shop-deletion'"
                :show="'shopDeletion'"
                :action="route('artisan.shop.destroy')"
                :password="true">
    <x-slot:heading>
        Excluir loja?
    </x-slot:heading>

    <x-slot:description>
        Todos seus produtos e encomendas serão excluídos permanentemente.
    </x-slot:description>
</x-modal-delete>
