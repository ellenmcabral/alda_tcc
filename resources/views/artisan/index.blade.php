<x-dashboard-layout>
    <div class="grid gap-8">
        <section class="grid gap-2">
            <h1 class="font-bold text-4xl">
                Oi, artesão
            </h1>
            <p class="text-sm text-gray-600">
                Bem-vindo(a) ao painel de controle da sua loja!
            </p>
        </section>

        <section class="grid gap-4">
            <p class="flex items-center border border-gray-300 rounded-lg p-4">
                <i class="mr-2 fa-solid fa-circle-info text-secondary-300 fa-xl"></i>
                Acesse o menu no topo superior para ver as opções de gerenciamento.
            </p>

            <p class="flex items-center border border-gray-300 rounded-lg p-4">
                <i class="mr-2 fa-solid fa-circle-info text-secondary-300 fa-xl"></i>
                Ou pressione um dos cards abaixo para navegar pelas opções de gerenciamento.
            </p>
        </section>

        <section class="grid grid-cols-2 gap-4">
            <a class="flex flex-col items-center justify-center rounded-xl shadow-md p-6 transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-100"
               href="{{ route('shop.show', Auth::user()->shop->url) }}">
                <i class="fa-solid fa-store text-primary-700 text-4xl"></i>
                <h3 class="mt-2 font-bold text-xl">
                    Minha Loja
                </h3>
                <p class="text-gray-400 text-center">
                    Veja a fachada da sua loja
                </p>
            </a>
            <a class="flex flex-col items-center justify-center rounded-xl shadow-md p-6 transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-100"
               href="{{ route('artisan.shop.settings') }}">
                <i class="fa-solid fa-gear text-primary-700 text-4xl"></i>
                <h3 class="mt-2 font-bold text-xl">
                    Configurações
                </h3>
                <p class="text-gray-400 text-center">
                    Edite os dados da sua loja
                </p>
            </a>
            <a class="flex flex-col items-center justify-center rounded-xl shadow-md p-6 transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-100"
               href="{{ route('artisan.products.index') }}">
                <i class="fa-solid fa-bag-shopping text-primary-700 text-4xl"></i>
                <h3 class="mt-2 font-bold text-xl">
                    Produtos
                </h3>
                <p class="text-gray-400 text-center">
                    Crie, edite ou exclua produtos
                </p>
            </a>
            <a class="flex flex-col items-center justify-center rounded-xl shadow-md p-6 transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-100"
               href="{{ route('artisan.commissions.index') }}">
                <i class="fa-solid fa-box-open text-primary-700 text-4xl"></i>
                <h3 class="mt-2 font-bold text-xl">
                    Encomendas
                </h3>
                <p class="text-gray-400 text-center">
                    Organize suas encomendas
                </p>
            </a>
        </section>
    </div>
</x-dashboard-layout>
