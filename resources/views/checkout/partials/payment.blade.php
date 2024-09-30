<section class="grid gap-4">
    <header class="flex items-center gap-2">
        <i class="fa-solid fa-money-check-dollar"></i>
        <x-text-subheading>
            Forma de Pagamento
        </x-text-subheading>
    </header>

    <p class="text-gray-dark">
        Escolha uma forma de pagamento para a sua encomenda.
    </p>

    <div class="grid gap-4" x-data="{ payment: 'pix' }" >
        <div class="grid gap-2">
            <div class="flex items-center">
                <x-input-radio type="radio"
                               id="pix"
                               name="payment"
                               value="pix"
                               x-model="payment"
                               checked />
                <x-input-label for="pix"
                               class="ml-2"
                               :value="'PIX'" />
            </div>
            <div class="flex items-center">
                <x-input-radio type="radio"
                               id="credit"
                               name="payment"
                               value="credit"
                               x-model="payment" />
                <x-input-label for="credit"
                               class="ml-2"
                               :value="'Cartão de crédito'"/>
            </div>
        </div>

        <div x-show="payment == 'credit'">
            <h2 class="text-sm text-gray-600">
                Campos de cartão de crédito
            </h2>
        </div>

        <div x-show="payment == 'pix'">
            <h2 class="text-sm text-gray-600">
                Informação de PIX
            </h2>
        </div>
    </div>
</section>
