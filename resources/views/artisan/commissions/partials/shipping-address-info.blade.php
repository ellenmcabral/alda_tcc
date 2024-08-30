<section id="shipping-address-info" class="max-w-xl">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Endereço de Entrega
        </h2>
    </header>

    <p>Rua: {{ $commission->shippingAddress->street }}</p>
    <p>Número: {{ $commission->shippingAddress->number }}</p>
    <p>Complemento: {{ $commission->shippingAddress->complement }}</p>
    <p>Bairro: {{ $commission->shippingAddress->locality }}</p>
    <p>Cidade: {{ $commission->shippingAddress->city }}</p>
    <p>Estado: {{ $commission->shippingAddress->region_code }}</p>
    <p>CEP: {{ $commission->shippingAddress->postal_code }}</p>
</section>
