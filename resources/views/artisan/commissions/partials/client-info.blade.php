<section id="client-info">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Dados do Cliente
        </h2>
    </header>

    <p>Nome: {{ $commission->user->name }}</p>
    <p>E-mail: {{ $commission->user->email }}</p>
    <p>Telefone: {{ $commission->user->phone_number }}</p>
</section>
