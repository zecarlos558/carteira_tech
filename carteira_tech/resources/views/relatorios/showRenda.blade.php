<x-div.chart>
    @section('title', 'Detalhe Relatório')
    @slot('tituloCentral')
        DETALHE DO RELATÓRIO
    @endslot
    <x-div.principal>
        @slot('titulo')
            Renda
        @endslot
        <x-div.row type="mt-2">
            <x-div.col>
                <x-div.card>
                    @slot('header')
                        <h3>Percentual das Entrada dos Planos</h3>
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
                        <h3>Evolução das Entrada Mensal</h3>
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
                                        <x-table.td>
                                            <x-div.button>
                                                <x-button.a class="btn-link"
                                                    href="{{ route('showMovimentoRenda', $movimento->id) }}">
                                                    {{ $movimento->nome }}</x-button.a>
                                            </x-div.button>
                                        </x-table.td>
                                        <x-table.td style="display: flex; color: blue;">
                                            {{ formatarData($movimento->data) }} </x-table.td>
                                        <x-table.td style="display: flex">R$ +{{ $movimento->valor }} </x-table.td>
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
                        <x-div.input id="card_body" style="height: 350px;" >
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

    </x-div.principal>
</x-div.chart>
