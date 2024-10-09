<x-dashboard-layout>
    <x-slot:heading>
        Minha Loja
    </x-slot:heading>

    <div class="grid gap-8 w-full h-fit md:w-1/2 xl:w-1/3">
        <section class="flex gap-4 items-center">
            <span class="w-20 h-20 rounded-full bg-gray-200">
                <!-- Imagem -->
            </span>

            <div>
                <h2 class="font-bold">
                    {{ Auth::user()->shop->name }}
                </h2>
                <a href="{{ route('shop.show', Auth::user()->shop->url) }}">
                    site.com.br/<span class="font-bold text-secondary-300">{{ Auth::user()->shop->url }}</span>
                </a>
            </div>
        </section>

        <section>
            <hr/>

            <a class="flex justify-between items-center px-4 py-8 text-secondary-regular font-bold text-lg hover:bg-gray-100 transition duration-300"
               href="{{ route('artisan.shop.information') }}">
                Informações
                <i class="fa-solid fa-pen text-gray-regular"></i>
            </a>

            <hr/>

            <a class="flex justify-between items-center px-4 py-8 text-secondary-regular font-bold text-lg hover:bg-gray-100 transition duration-300"
               href="{{ route('artisan.shop.customization') }}">
                Personalização
                <i class="fa-solid fa-pen text-gray-regular"></i>
            </a>

            <hr/>

            <a class="flex justify-between items-center px-4 py-8 text-secondary-regular font-bold text-lg hover:bg-gray-100 transition duration-300"
               href="{{ route('artisan.shop.address.edit') }}">
                Endereço
                <i class="fa-solid fa-pen text-gray-regular"></i>
            </a>

            <hr/>
        </section>

        @include('artisan.shop.partials.delete-shop-form')
    </div>
</x-dashboard-layout>
