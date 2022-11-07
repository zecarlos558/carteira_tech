<x-div.main>
    @section('title','DASHBOARD')
    @slot('tituloCentral')
        DASHBOARD
    @endslot
    <x-div.principal>
        @slot('titulo')
        Contas
        @endslot
        @slot('rodape')
        <x-div.button>
            <x-button.a icon="pesquisar" href="{{ route('indexConta') }}">Ver Contas</x-button.a>
        </x-div.button>
        @endslot
        <x-div.table-show>
            <x-table.thead>
                <x-table.tr>
                    <x-table.th scope="col">Nome</x-table.th>
                    <x-table.th scope="col">Valor</x-table.th>
                </x-table.tr>
            </x-table.thead>
            <x-table.tbody>
                @foreach ($contas as $conta)
                    <x-table.tr>
                        <x-table.td-show>{{ $conta->nome }}</x-table.td-show>
                        <x-table.td>{{ $conta->valor }}</x-table.td>
                    </x-table.tr>
                    @break($loop->index == 2)
                @endforeach
                <x-table.tr class="table-success">
                    <x-table.td-show>Total:</x-table.td-show>
                    <x-table.td>{{ $contas->sum('valor') }}</x-table.td>
                </x-table.tr>
            </x-table.tbody>
        </x-div.table-show>

        <x-div.row>
            <x-div.col>
                <x-div.card>
                    @slot('header')
                        <h3>Resumo Mensal - {{ucfirst(formataMes(date('m')))}}</h3>
                    @endslot
                    @slot('corpo')
                    <x-div.input>
                        <h4>Saídas</h4>
                        <h5>{{ $relatorio->valorTotalSaida }}</h5>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar"
                                style="width: {{ $relatorio->barraProgressoSaida }}%"
                                aria-valuenow="{{ $relatorio->barraProgressoSaida }}" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </x-div.input>
                    <x-div.input>
                        <h4>Renda</h4>
                        <h5>{{ $relatorio->valorTotalEntrada }}</h5>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ $relatorio->barraProgressoEntrada }}%"
                                aria-valuenow="{{ $relatorio->barraProgressoEntrada }}" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </x-div.input>
                    <x-div.input class="mt-3">
                        <h4>Saldo: {{$relatorio->valorTotalEntrada - $relatorio->valorTotalSaida}}</h4>
                    </x-div.input>
                    @endslot
                    @slot('rodape')
                        <x-div.button>
                            <x-button.a icon="pesquisar" href="{{ route('indexRelatorio') }}">Ver Painel</x-button.a>
                        </x-div.button>
                    @endslot
                </x-div.card>
            </x-div.col>
            <x-div.col>
                <x-div.card>
                    @slot('header')
                        <h3>Últimas Transações</h3>
                    @endslot
                    @slot('corpo')
                    <x-div.table style="height: 215px;" idTabela="condensada">
                        <x-table.tbody>
                            @foreach ($movimentos as $movimento)
                                <x-table.tr>
                                    <x-table.td>
                                        <x-div.button>
                                            @if ($movimento->tipo == 'suprimento')
                                                <x-button.a class="btn-link" href="{{ route('showMovimentoRenda', $movimento->id) }}">{{ $movimento->nome }}</x-button.a>
                                            @else
                                                <x-button.a class="btn-link" href="{{ route('showMovimentoGasto', $movimento->id) }}">{{ $movimento->nome }}</x-button.a>
                                            @endif
                                        </x-div.button>
                                    </x-table.td>
                                    <x-table.td style="display: flex; color: blue;" > {{formatarData($movimento->data)}} </x-table.td>
                                    @if ($movimento->tipo == 'suprimento')
                                    <x-table.td style="display: flex" >R$  +{{$movimento->valor}} </x-table.td>
                                    @else
                                    <x-table.td style="display: flex" >R$  -{{$movimento->valor}} </x-table.td>
                                    @endif
                                </x-table.tr>
                            @endforeach
                        </x-table.tbody>
                    </x-div.table>
                    @endslot
                    @slot('rodape')
                        <x-div.button>
                            <x-button.a  href="{{ route('indexMovimento') }}" icon="pesquisar">Ver Transações</x-button.a>
                        </x-div.button>
                    @endslot
                </x-div.card>
            </x-div.col>
        </x-div.row>

        <div class=" mt-3 container-fluid px-lg-5">
            <h2 class="pb-2 border-bottom">Transações</h2>
            <!-- Page Features-->
            <div class="row gx-lg-5">
                <div class="col">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <a class="feature-icon bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4" href="{{ route('createMovimentoRenda') }}"><ion-icon name="add-circle"></ion-icon></a>
                            <h2 class="fs-4 fw-bold">Entrada</h2>
                            <p class="mb-0">Transação de Suprimento</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <a class="feature-icon bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4" href="{{ route('createMovimentoGasto') }}"><ion-icon name="add-circle"></ion-icon></a>
                            <h2 class="fs-4 fw-bold">Saída</h2>
                            <p class="mb-0">Transação de Retirada</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-lg-5">
            <h2 class="pb-2 border-bottom">Contas</h2>
            <!-- Page Features-->
            <div class="row gx-lg-5">
                <div class="col">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <a class="feature-icon bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4" href="{{ route('indexConta') }}"><ion-icon name="list-sharp"></ion-icon></a>
                            <h2 class="fs-4 fw-bold">Listar</h2>
                            <p class="mb-0">Listar Contas</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <a class="feature-icon bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4" href="{{ route('createConta') }}"><ion-icon name="add-circle"></ion-icon></a>
                            <h2 class="fs-4 fw-bold">Cadastrar</h2>
                            <p class="mb-0">Cadastrar nova Conta</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-div.principal>
</x-div.main>
