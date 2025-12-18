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
            {{ $parametros['desc_data'] }}
        @endslot
        <x-nav_pills.div-content>

            <x-nav_pills.content id="resumo" type="active">
                <x-div.row type="justify-content-around" id="painel-header">
                    <x-div.col type="-auto">
                        <x-button.a class="btn-outline-success" href="{{ route('showRelatorioRenda', $parametros) }}">
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
                        <x-button.a class="btn-outline-danger" href="{{ route('showRelatorioGasto', $parametros) }}">
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
                <x-div.form action="{{ route('indexRelatorio') }}" method="post">
                    @slot('header')
                        Consultar Dados por Data
                    @endslot
                    <x-label.label for="opcao_data">Tipo da Consulta:</x-label.label>
                    <x-input.select id="opcao_data" name="opcao_data" onChange="selecionaData();">
                        <x-input.option value="mensal">Mensal</x-input.option>
                        <x-input.option value="personalizado">Personalizado</x-input.option>
                    </x-input.select>
                    <div class="input-group" id="mensal">
                        <x-label.span class="input-group-text" icon='calendario'>Data Mês</x-label.span>
                        <x-input.date-month id="data" name="data" value="{{ date('Y-m', strtotime(@$parametros['data'])) }}">
                        </x-input.date-month>
                    </div>
                    <div id="personalizado" style="display: none;">
                        <x-div.row>
                            <x-div.col>
                                <x-label.span class="input-group-text" icon='calendario'>Data Inicio</x-label.span>
                                <x-input.date-month id="dataInicio" name="dataInicio" value="{{ date('Y-m', strtotime(@$parametros['dataInicio'] ?? date('Y-m'))) }}">
                                </x-input.date-month>
                            </x-div.col>
                            <x-div.col>
                                <x-label.span class="input-group-text" icon='calendario'>Data Fim</x-label.span>
                                <x-input.date-month id="dataFim" name="dataFim" value="{{ date('Y-m', strtotime(@$parametros['dataFim'] ?? date('Y-m'))) }}">
                                </x-input.date-month>
                            </x-div.col>
                        </x-div.row>
                    </div>
                    @slot('rodape')
                        <x-button.button type="submit" class="btn-primary" icon='pesquisar'>Consultar</x-button.button>
                    @endslot
                </x-div.form>
            </x-nav_pills.content>
        </x-nav_pills.div-content>
        <script>
            $(document).ready(function() {
                opcao_data = "{{ @$parametros['opcao_data'] }}";
                if (opcao_data) {
                    $('#opcao_data').val(opcao_data).trigger('change');
                }
            });
        </script>
    </x-div.principal>
</x-div.main>
