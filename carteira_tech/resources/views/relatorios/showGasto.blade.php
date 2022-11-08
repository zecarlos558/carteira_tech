<x-div.chart>
    @section('title', 'Detalhe Relatório')
    @slot('tituloCentral')
        DETALHE DO RELATÓRIO
    @endslot
    <x-div.principal>
        @slot('titulo')
            <x-nav_pills.div-menu>
                <x-nav_pills.menu type="active" href="gasto">Gastos</x-nav_pills.menu>
                <x-nav_pills.menu type="fade" href="filtro">Filtrar</x-nav_pills.menu>
            </x-nav_pills.div-menu>
        @endslot
        @slot('rodape')
            {{ formataDataRelatorio($data) }}
        @endslot
        <x-nav_pills.div-content>

            <x-nav_pills.content id="gasto" type="active">
                <x-div.row>
                    <x-div.col>
                        <x-div.card>
                            @slot('header')
                                <h3>Percentual das Saidas dos Planos</h3>
                            @endslot
                            @slot('corpo')
                                @if ($array['nomes'] != null)
                                    <x-chart.doughnut :array="$array" />
                                @else
                                    <div class="d-none d-lg-block" id="div_pai_center">
                                        <div id="div_filho_center">
                                            <h5>Não foi encontrado dados para essa consulta!</h5>
                                        </div>
                                    </div>
                                @endif
                            @endslot
                        </x-div.card>
                    </x-div.col>
                    @if (session(['device' => checkDevice()]) == false)
                        <x-div.col>
                            <x-div.card>
                                @slot('header')
                                    <h3>Evolução das Saidas Mensal</h3>
                                @endslot
                                @slot('corpo')
                                    @if ($array['valorTotal'] != null)
                                        <x-chart.bar :array="$array" />
                                    @else
                                        <div class="d-none d-lg-block" id="div_pai_center">
                                            <div id="div_filho_center">
                                                <h5>Não foi encontrado dados para essa consulta!</h5>
                                            </div>
                                        </div>
                                    @endif
                                @endslot
                            </x-div.card>
                        </x-div.col>
                    @endif
                </x-div.row>
                <x-div.row>
                    <x-div.col>
                        <x-div.card class="mt-2">
                            @slot('header')
                                <h3>Transações</h3>
                            @endslot
                            @slot('corpo')
                                <x-div.table style="height: 350px;" idTabela="condensada">
                                    <x-table.tbody>
                                        @foreach ($movimentos as $movimento)
                                            <x-table.tr>
                                                <x-table.td style="display: flex">{{ $movimento->categoria->nome }}
                                                </x-table.td>
                                                <x-table.td style="display: flex">
                                                    <h5>{{ $movimento->nome }}</h5>
                                                </x-table.td>
                                                <x-table.td></x-table.td>
                                                <x-table.td style="display: flex; color: blue;">
                                                    {{ formatarData($movimento->data) }} </x-table.td>
                                                <x-table.td style="display: flex; color: red">R$
                                                    -{{ $movimento->valor }} </x-table.td>
                                            </x-table.tr>
                                        @endforeach
                                    </x-table.tbody>
                                </x-div.table>
                            @endslot
                        </x-div.card>
                    </x-div.col>
                    <x-div.col>
                        <x-div.card class="mt-2">
                            @slot('header')
                                <h3>Categorias</h3>
                            @endslot
                            @slot('corpo')
                                <x-div.input id="card_body" style="height: 350px;">
                                    @foreach ($relatorioCategorias as $relatorios)
                                        <h4>{{ $relatorios->nome }}</h4>
                                        <h5>{{ $relatorios->valorTotal }}</h5>
                                        <div class="progress pd-3 mb-3">
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                style="width: {{ $relatorios->barraProgresso }}%"
                                                aria-valuenow="{{ $relatorios->barraProgresso }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    @endforeach
                                </x-div.input>
                            @endslot
                        </x-div.card>
                    </x-div.col>
                </x-div.row>
            </x-nav_pills.content>

            <x-nav_pills.content id="filtro" type="fade">
                <x-div.form action="{{ route('showRelatorioGasto') }}" method="get">
                    @slot('header')
                        Consultar Dados por Data
                    @endslot
                    <x-label.label for="opcao_data">Tipo da Consulta:</x-label.label>
                    <x-input.select id="opcao_data" name="opcao_data" onChange="selecionaData();">
                        <x-input.option value="mensal">Mensal</x-input.option>
                        <x-input.option value="personalizado">Personalizado</x-input.option>
                    </x-input.select>
                    <div id="mensal">
                        <x-label.span class="input-group-text" icon='calendario'>Data Mês</x-label.span>
                        <x-input.date-month id="data" name="data" value="{{ date('Y-m') }}">
                        </x-input.date-month>
                    </div>
                    <div id="personalizado" style="display: none;">
                        <x-div.row>
                            <x-div.col>
                                <x-label.span class="input-group-text" icon='calendario'>Data Inicio</x-label.span>
                                <x-input.date-month id="dataInicio" name="dataInicio" value="{{ date('Y-m') }}">
                                </x-input.date-month>
                            </x-div.col>
                            <x-div.col>
                                <x-label.span class="input-group-text" icon='calendario'>Data Fim</x-label.span>
                                <x-input.date-month id="dataFim" name="dataFim" value="{{ date('Y-m') }}">
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


    </x-div.principal>
</x-div.chart>
