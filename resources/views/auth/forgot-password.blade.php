<x-app-layout>
    <div class="grid gap-8 w-full lg:w-1/2 xl:w-1/3">
        <x-text-heading>
            Recuperar Senha
        </x-text-heading>

        <x-form action="{{ route('password.email') }}">
            <p>
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
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

            <x-button class="w-full">
                Enviar
            </x-button>

            <x-link class="text-center"
                    href="{{ route('login') }}">
                Voltar
            </x-link>
        </x-form>
    </div>
</x-app-layout>
