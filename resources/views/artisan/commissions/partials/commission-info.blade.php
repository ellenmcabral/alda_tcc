<section id="commission-info">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Informações da Encomenda
        </h2>
    </header>
    <p class="@if($commission->status->id > 1 and $commission->status->id < 6)
                                   text-yellow-300
                              @else
                                   text-green-500
                              @endif ">
        Status: {{ $commission->status->description }}
    </p>
    <p>Data: {{ date('d/m/Y', strtotime($commission->created_at)) }}</p>
    <p>Última atualização: {{ date('d/m/Y', strtotime($commission->updated_at)) }}</p>
</section>
