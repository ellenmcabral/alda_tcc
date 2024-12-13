<x-app-layout>
    <x-slot:heading>
        Fazer Login
    </x-slot:heading>

    <div class="grid gap-8 w-full h-fit md:w-1/2 xl:w-1/3">
        <x-form :width="'full'"
                action="{{ route('login') }}">
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
            <div class="flex items-center gap-2">
                <x-input-checkbox id="remember_me"
                                  name="remember" />
                <x-input-label for="remember_me"
                               :value="'Manter conectado'" />
            </div>

            <x-button>
                Entrar
            </x-button>
        </x-form>

        <x-link class="text-center"
                href="{{ route('register') }}">
            Criar uma conta
        </x-link>
    </div>
</x-app-layout>
