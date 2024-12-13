<x-app-layout>
    <x-slot:heading>
        Minha Conta
    </x-slot:heading>

    <div class="grid gap-8 w-full h-fit md:w-1/2 xl:w-1/3">
        <section class="flex gap-4 items-center">
            <x-image src="/img/assets/user.png"
                     alt="Imagem de perfil do usuário {{ Auth::user()->name }}"
                     class="w-20 h-20 rounded-full bg-gray-200" />
            <div>
                <x-text-subheading>
                    {{ Auth::user()->name }}
                </x-text-subheading>
                <x-text>
                    {{ Auth::user()->email }}
                </x-text>
            </div>
        </section>

        <section>
            <hr/>

            <a class="flex justify-between items-center px-4 py-8 text-secondary-regular font-bold text-lg hover:bg-gray-100 transition duration-300"
               href="{{ route('profile.edit') }}">
                Dados Pessoais
                <i class="fa-solid fa-pen text-gray-regular"></i>
            </a>

            <hr/>

            <a class="flex justify-between items-center px-4 py-8 text-secondary-regular font-bold text-lg hover:bg-gray-100 transition duration-300"
               href="{{ route('profile.shipping-addresses.index') }}">
                Endereços de Entrega
                <i class="fa-solid fa-pen text-gray-regular"></i>
            </a>

            <hr/>

            <a class="flex justify-between items-center px-4 py-8 text-secondary-regular font-bold text-lg hover:bg-gray-100 transition duration-300"
               href="{{ route('profile.password.edit') }}">
                Editar Senha
                <i class="fa-solid fa-pen text-gray-regular"></i>
            </a>

            <hr/>
        </section>

        @include('profile.partials.delete-user-form')
    </div>
</x-app-layout>
