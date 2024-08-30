<section id="payment-info" class="max-w-xl">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Opção de Pagamento
        </h2>
        @if($commission->payment == 'credit')
            <p class="mt-4 text-gray-200">Vou pagar com cartão de crédito.</p>
        @else
            <p class="mt-4 text-gray-200">Vou pagar com PIX.</p>
        @endif
    </header>
</section>
