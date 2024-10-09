<x-app-layout>
    <x-slot:heading>
        Recuperar Senha
    </x-slot:heading>

    <div class="grid gap-8 w-full h-fit md:w-1/2 xl:w-1/3">
        <x-form :width="'full'"
                action="{{ route('password.email') }}">
            <p>
                Informe seu endereço de e-mail que enviaremos um link que permitirá definir uma nova senha.
            </p>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-input-text id="email"
                              class="w-full"
                              type="email"
                              name="email"
                              :value="old('email')"
                              placeholder="Digite o seu e-mail"
                              required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <x-button>
                Enviar
            </x-button>

            <x-link href="{{ route('login') }}">
                Voltar para a página de login
            </x-link>
        </x-form>
    </div>
</x-app-layout>
