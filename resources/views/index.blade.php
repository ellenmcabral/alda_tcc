<x-app-layout>
    <div class="grid gap-16">
        <section class="grid gap-4 text-center">
            <h1 class="font-extrabold text-4xl mt-8">Uma plataforma acolhedora para artesãos</h1>
            <p>O lugar ideal para a venda e exposição de artes e artesanato de todos os tipos</p>
            <div class="flex flex-col">
                <a class="font-bold bg-primary-700 p-3 rounded-xl"
                   href="{{ route('shop.create') }}">
                    Criar minha loja
                </a>
                <a class="mt-4 font-bold border-solid border-2 border-primary-700 p-3 rounded-xl"
                   href="{{ route('login') }}">
                    Já tenho uma loja
                </a>
            </div>
        </section>
        <section class="grid gap-8">
            <div class="p-4 bg-white rounded shadow-md">
                <h2 class="font-bold text-2xl">Crie sua loja</h2>
                <p class="mt-2">Os seus produtos ficarão na página da sua loja, acessíveis para qualquer um na internet conseguir ver e comprar!</p>
            </div>
            <div class="p-4 bg-white rounded shadow-md">
                <h2 class="font-bold text-2xl">Venda com praticidade</h2>
                <p class="mt-2">Nossa interface é limpa e sem complicação. Sabemos que artesanato toma bastante tempo, então você vai publicar seus produtos e vender sem se preocupar!</p>
            </div>
            <div class="p-4 bg-white rounded shadow-md">
                <h2 class="font-bold text-2xl">Faça parte da comunidade</h2>
                <p class="mt-2">Pesquise por artesanato de vários outros locais. Crochê, biscuit ou madeira. Todos os tipos tem o seu lugar aqui!</p>
            </div>
        </section>
        <section>
            <h1 class="font-extrabold text-4xl">Artesão, vem abrir a sua loja na Alda</h1>
            <a class="flex justify-between items-center font-bold mt-4 bg-secondary-300 p-3 rounded-xl w-full"
               href="{{ route('register') }}">
                Começar agora
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </section>
    </div>
</x-app-layout>
