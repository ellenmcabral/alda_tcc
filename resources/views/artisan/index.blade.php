<x-dashboard-layout>
    <div class="w-full h-fit grid gap-10 lg:w-2/3">
        <section class="grid gap-2">
            <x-text-heading>
                Painel do Artesão
            </x-text-heading>
            <p class="text-lg">
                Sua loja já está ativa no link:
            </p>
            <div class="flex gap-2 items-center text-lg">
                <span class="bg-accent-regular h-4 w-4 rounded-full animate-pulse"></span>
                <a href="{{ route('shop.show', Auth::user()->shop->url) }}"
                   class="underline text-gray-dark hover:text-neutral-black transition duration-300">
                    https://site.com/shop/<span class="font-bold">{{ Auth::user()->shop->url }}</span>
                </a>
            </div>
        </section>

        <section class="flex gap-2 items-start border border-gray-regular rounded-lg p-4 text-gray-dark">
            <i class="mt-3 fa-solid fa-circle-info text-gray-regular fa-xl"></i>
            <p>
                Para navegar, acesse o menu superior (<i class="text-gray-regular fa-solid fa-bars"></i>) ou pressione um dos cards abaixo.
            </p>
        </section>

        <section class="grid grid-cols-2 xl:grid-cols-4 gap-4 md:gap-8">
            <x-card-dashboard :route="route('shop.show', Auth::user()->shop->url)"
                              :icon="'fa-store'"
                              :title="'Minha Loja'"
                              :text="'Veja a fachada da sua loja'" />

            <x-card-dashboard :route="route('artisan.products.index')"
                              :icon="'fa-bag-shopping'"
                              :title="'Produtos'"
                              :text="'Crie, edite ou exclua produtos'" />

            <x-card-dashboard :route="route('artisan.commissions.index')"
                              :icon="'fa-box-open'"
                              :title="'Encomendas'"
                              :text="'Organize suas encomendas'" />

            <x-card-dashboard :route="route('artisan.shop.settings')"
                              :icon="'fa-gear'"
                              :title="'Configurações'"
                              :text="'Edite os dados da sua loja'" />
        </section>

        <section>
            <x-text-heading>
                Últimas encomendas
            </x-text-heading>
        </section>
    </div>
</x-dashboard-layout>
