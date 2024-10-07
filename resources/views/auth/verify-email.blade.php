<x-app-layout>
    <div class="grid gap-8 w-full h-fit md:w-1/2 xl:w-1/3">
        <x-text-heading>
            Verificar E-mail
        </x-text-heading>

        <x-form action="{{ route('verification.send') }}">
            <p>
                Enviamos um e-mail de verificação. Verifique sua caixa de entrada. Se não chegou é só solicitar outro.
            </p>

            <div>
                <x-button class="w-full">
                    Reenviar e-mail
                </x-button>
            </div>
        </x-form>

        <form class="flex justify-center" method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                    class="underline text-lg font-bold text-secondary-regular hover:text-secondary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-regular">
                Sair da conta
            </button>
        </form>
    </div>
</x-app-layout>
