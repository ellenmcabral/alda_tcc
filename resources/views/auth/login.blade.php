<x-app-layout>
    <x-slot name="heading">
        Fazer Login
    </x-slot>

    <form class="grid gap-12 w-full sm:w-1/2 lg:w-1/3" method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-input-text id="email"
                          class="w-full"
                          type="email"
                          name="email"
                          :value="old('email')"
                          required autofocus autocomplete="username"
                          placeholder="Digite o seu e-mail" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-input-text id="password"
                          class="w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"
                          placeholder="Digite a sua senha" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            @if (Route::has('password.request'))
                <x-link class="mt-4 flex justify-end" href="{{ route('password.request') }}">
                    Esqueci minha senha
                </x-link>
            @endif
        </div>

        <!-- Remember Me -->
        <div>
            <label for="remember_me" class="cursor-pointer inline-flex items-center">
                <input id="remember_me"
                       type="checkbox"
                       class="cursor-pointer rounded focus:ring-accent-regular checked:focus:bg-accent-dark checked:bg-accent-dark"
                       name="remember">
                <span class="ml-2 text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <x-button-primary class="w-full">
            {{ __('Log in') }}
        </x-button-primary>

        <x-link class="text-center"
                href="{{ route('register') }}">
            Criar uma conta
        </x-link>
    </form>
</x-app-layout>
