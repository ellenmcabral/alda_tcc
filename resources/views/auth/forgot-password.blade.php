<x-app-layout>
    <x-slot name="heading">
        Recuperar Senha
    </x-slot>

    <form class="grid gap-8" method="POST" action="{{ route('password.email') }}">
        @csrf

        <p >
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

        <x-button-primary class="w-full">
            Enviar
        </x-button-primary>

        <x-link class="text-center"
                href="{{ route('login') }}">
            Voltar
        </x-link>
    </form>
</x-app-layout>
