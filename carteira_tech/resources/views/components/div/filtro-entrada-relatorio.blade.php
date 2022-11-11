<div {{ $attributes->merge(['class' => 'container-fluid']) }} id="tech-container">
    @foreach ($relatorioEntradaSinteticos as $relatorioEntradaSintetico)
            <div id="componentPanelRelatorio" class="panel-group">
                <div class="panel-heading">
                    <h2>{{$relatorioEntradaSintetico->nome}}</h2>
                </div>
            </div>
            @if ($relatorioEntradaSintetico->quantidadeEntradas > 0)
                <table class="table table-striped table-hover">
                    <thead class="table-success" >
                        <tr>
                            <th scope="col">#</th>
                            @if ($relatorioEntradaSinteticos->tipo != 'plano')
                            <th scope="col">Plano Pagamento</th>
                            @endif
                            <th scope="col">Total Produtos</th>
                            <th scope="col">Valor Total</th>
                            <th scope="col">Valor Pago</th>
                        </tr>
                    </thead>
                    <tbody id="tabelaPesquisa">
                        @foreach ($relatorioEntradas as $key => $relatorioEntrada)
                            @if ($relatorioEntrada->nome == $relatorioEntradaSintetico->nome)
                                <tr>
                                    <th scope="row">{{($loop->index)+1}}</th>
                                    @if ($relatorioEntradaSinteticos->tipo != 'plano')
                                    <td>{{$relatorioEntrada->planoPagamento}}</td>
                                    @endif
                                    <td>{{$relatorioEntrada->TotalQtdItem}}</td>
                                    <td>{{$relatorioEntrada->valorTotal}}</td>
                                    <td>{{$relatorioEntrada->totalPago}}</td>
                                </tr>

                            @endif
                        @endforeach
                        <tr class="table-warning">
                            <th class="tdShow">Total Entradas:</th>
                            <td>{{$relatorioEntradaSintetico->quantidadeEntradas}}</td>
                        </tr>
                    </tbody>
                </table>
            @else
                <h5>Não há entradas vinculados nessa opção</h5>
            @endif
        @endforeach
</div>
