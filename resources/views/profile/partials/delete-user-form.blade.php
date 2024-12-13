<x-button-danger class="uppercase"
                 x-data=""
                 x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
    Excluir Conta
</x-button-danger>

<x-modal-delete name="confirm-user-deletion"
                :show="'userDeletion'"
                :action="route('profile.destroy')"
                :password="true">
    <x-slot:heading>
        Excluir sua conta?
    </x-slot:heading>

    <x-slot:description>
        Todos os seus dados serão perdidos permanentemente.
    </x-slot:description>
</x-modal-delete>
