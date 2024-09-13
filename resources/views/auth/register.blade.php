<x-app-layout>
    <x-slot name="heading">
        Criar Conta
    </x-slot>

    <form class="grid gap-8"
          method="POST"
          action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="'Nome'"/>
            <x-text-input id="name"
                          class="w-full"
                          type="text"
                          name="name"
                          :value="old('name')"
                          placeholder="Digite o seu nome completo"
                          required autofocus autocomplete="name"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="'E-mail'"/>
            <x-text-input id="email"
                          class="w-full"
                          type="email"
                          name="email"
                          :value="old('email')"
                          placeholder="Digite o seu e-mail"
                          required autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Phone -->
        <div x-data>
            <x-input-label for="phone" :value="'Telefone'"/>
            <x-text-input id="phone"
                          class="w-full"
                          type="text"
                          name="phone"
                          :value="old('phone')"
                          required autocomplete="username"
                          x-mask="(99) 9 9999-9999"
                          placeholder="(00) 0 0000-0000"/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="'Senha (no mínimo 8 caracteres)'"/>
            <x-text-input id="password"
                          class="w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password"
                          placeholder="Digite a sua senha"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>
            <x-text-input id="password_confirmation"
                          class="w-full"
                          type="password"
                          name="password_confirmation"
                          required autocomplete="new-password"
                          placeholder="Digite a sua senha novamente"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <x-primary-button class="w-full">
            Enviar
        </x-primary-button>

        <a class="text-center underline text-lg text-secondary-300 hover:text-secondary-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-700"
           href="{{ route('login') }}">
            Já tenho uma conta
        </a>
    </form>
</x-app-layout>
