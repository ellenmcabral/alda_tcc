<x-app-layout>
    <x-slot:heading>
        Criar Conta
    </x-slot:heading>

    <div class="grid gap-8 w-full h-fit md:w-1/2 xl:w-1/3">
        <x-form :width="'full'"
                action="{{ route('register') }}">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="'Nome'"/>
                <x-input-text id="name"
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
                <x-input-text id="email"
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
                <x-input-text id="phone"
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
                <x-input-text id="password"
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
                <x-input-text id="password_confirmation"
                              class="w-full"
                              type="password"
                              name="password_confirmation"
                              required autocomplete="new-password"
                              placeholder="Digite a sua senha novamente"/>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
            </div>

            <x-button>
                Cadastrar
            </x-button>
        </x-form>

        <x-link class="text-center"
                href="{{ route('login') }}">
            Já tenho uma conta
        </x-link>
    </div>
</x-app-layout>
