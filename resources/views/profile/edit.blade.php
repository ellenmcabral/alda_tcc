<x-app-layout>
    <x-slot name="heading">
        Minha Conta
    </x-slot>

    <section class="grid gap-4">
        <span class="w-full h-40 bg-gray-200">
            <!-- Imagem -->
        </span>

        <div class="flex items-center gap-2">
            <span class="w-16 h-16 bg-gray-200 rounded-full">
                <!-- Imagem -->
            </span>
            <div class="flex flex-col">
                <h2 class="font-extrabold">
                    {{ Auth::user()->name }}
                </h2>
                <p class="uppercase text-xs">
                    {{ Auth::user()->email }}
                </p>
            </div>
        </div>
        <div class="flex justify-between items-center">
            <x-link class="py-4" href="{{ route('profile.information.edit') }}">
                Dados Pessoais
            </x-link>
            <i class="fa-solid fa-pen text-gray-400"></i>
        </div>
        <hr/>
        <div class="flex justify-between items-center">
            <x-link class="py-4" href="{{ route('profile.shipping-address.index') }}">
                Endereços de Entrega
            </x-link>
            <i class="fa-solid fa-pen text-gray-400"></i>
        </div>
        <hr/>
        <div class="flex justify-between items-center">
            <x-link class="py-4" href="{{ route('profile.password.edit') }}">
                Editar Senha
            </x-link>
            <i class="fa-solid fa-pen text-gray-400"></i>
        </div>

        @include('profile.partials.delete-user-form')
    </section>
</x-app-layout>
