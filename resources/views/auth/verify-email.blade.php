<x-app-layout>
    <div class="grid gap-8 w-full lg:w-1/2 xl:w-1/3">
        <x-heading>
            Verificar E-mail
        </x-heading>

        <x-form action="{{ route('verification.send') }}">
            <p>
                Enviamos um e-mail de verificação. Verifique sua caixa de entrada. Se não chegou é só solicitar outro.
            </p>

            <div>
                <x-button-primary class="w-full">
                    Reenviar e-mail
                </x-button-primary>
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
