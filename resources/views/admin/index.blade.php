<x-dashboard-layout>
    <x-slot:heading>
        Painel do Administrador
    </x-slot:heading>

    <div class="w-full h-fit grid gap-16 md:w-2/3">
        <section class="grid gap-4 lg:grid-cols-2 md:gap-8">
            <x-card-dashboard :route="route('admin.users.index')"
                              :icon="'fa-users'"
                              :title="'Usuários'"
                              :text="'Edite ou exclua usuários'" />

            <x-card-dashboard :route="route('admin.shops.index')"
                              :icon="'fa-store'"
                              :title="'Lojas'"
                              :text="'Edite ou exclua lojas'" />
        </section>
    </div>
</x-dashboard-layout>
