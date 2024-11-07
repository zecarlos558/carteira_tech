<x-div.main>
    @section('title', 'Relatório')
    @slot('tituloCentral')
        Relatório Financeiro
    @endslot
    <x-div.principal>
        @slot('titulo')
        <x-nav_pills.div-menu >
            <x-nav_pills.menu type="active" href="resumo">Resumo</x-nav_pills.menu>
            <x-nav_pills.menu type="fade" href="filtro">Filtrar</x-nav_pills.menu>
        </x-nav_pills.div-menu>
        @endslot
        @slot('rodape')
        {{ formataDataRelatorio($data) }}
        @endslot
        <x-nav_pills.div-content>

            <x-nav_pills.content id="resumo" type="active">
                <x-div.row type="justify-content-around" id="painel-header">
                    <x-div.col type="-auto">
                        <x-button.a class="btn-outline-success" href="{{ route('showRelatorioRenda', ['data' => $data]) }}">
                            <x-div.card class="bg-success" style="color: white">
                                @slot('header')
                                    Renda
                                @endslot
                                @slot('corpo')
                                    <h1>
                                        <x-label.span-default style="text-align: center">
                                            {{ $relatorio->getValorEntrada() }} R$</x-label.span>
                                    </h1>
                                @endslot
                            </x-div.card>
                        </x-button.a>
                    </x-div.col>
                    <x-div.col type="-auto">
                        <x-button.a class="btn-outline-danger" href="{{ route('showRelatorioGasto') }}">
                            <x-div.card class="bg-danger" style="color: white">
                                @slot('header')
                                    Gastos
                                @endslot
                                @slot('corpo')
                                    <h1>
                                        <x-label.span-default style="text-align: center">
                                            {{ $relatorio->getValorSaida() }} R$</x-label.span>
                                    </h1>
                                @endslot
                            </x-div.card>
                        </x-button.a>
                    </x-div.col>
                </x-div.row>
                <hr>
                <x-div.input class="border" id="tech-container">
                    @foreach ($relatorioCategorias as $relatorios)
                        <h4>{{ $relatorios->nome }}</h4>
                        <h5>{{ formatarNumero($relatorios->valorTotal) }} R$</h5>
                        <div class="progress pd-3 mb-3">
                            @if ($relatorios->tipo == "suprimento")
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ $relatorios->barraProgresso }}%"
                                    aria-valuenow="{{ $relatorios->barraProgresso }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            @else
                                <div class="progress-bar bg-danger" role="progressbar"
                                    style="width: {{ $relatorios->barraProgresso }}%"
                                    aria-valuenow="{{ $relatorios->barraProgresso }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            @endif
                        </div>
                    @endforeach
                </x-div.input>
            </x-nav_pills.content>

            <x-nav_pills.content id="filtro" type="fade">
                <x-div.form action="{{ route('indexRelatorio') }}" method="get">
                    @slot('header')
                        Consultar Dados por Data
                    @endslot
                    <div class="input-group" id="mensal">
                        <x-label.span class="input-group-text" icon='calendario'>Data Mês</x-label.span>
                        <x-input.date-month id="data" name="data" value="{{ date('Y-m') }}">
                        </x-input.date-month>
                    </div>
                    @slot('rodape')
                        <x-button.button type="submit" class="btn-primary" icon='pesquisar'>Consultar</x-button.button>
                    @endslot
                </x-div.form>
            </x-nav_pills.content>

        </x-nav_pills.div-content>

    </x-div.principal>
</x-div.main>
