<div {{ $attributes->merge(['class' => 'container-fluid']) }} id="tech-container" >
    @foreach ($relatorioSaidaSinteticos as $relatorioSaidaSintetico)
        <div id="componentPanelRelatorio" class="panel-group">
            <div class="panel-heading">
                <h2>{{ $relatorioSaidaSintetico->nome }}</h2>
            </div>
        </div>
        @if ($relatorioSaidaSintetico->quantidadeVendas > 0)
            <table class="table table-striped table-hover">
                <thead class="table-success">
                    <tr>
                        <th scope="col">#</th>
                        @if ($relatorioSaidaSinteticos->tipo != 'plano')
                            <th scope="col">Pagamento</th>
                            <th scope="col">Vendas</th>
                        @endif
                        <th scope="col">Produtos</th>
                        <th scope="col">Valor Total</th>
                        <th scope="col">Valor Pago</th>
                    </tr>
                </thead>
                <tbody id="tabelaPesquisa">
                    @foreach ($relatorioSaidas as $key => $relatorioSaida)
                        @if ($relatorioSaida->nome == $relatorioSaidaSintetico->nome)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                @if (($relatorioSaidaSinteticos->tipo == 'cliente') && ($relatorioSaida->tipoPagamento == 'credito') && ($relatorioSaida->statusVenda != 'finalizado'))
                                    <form action="{{ route('indexVenda') }}" id="formVenda" method="get">
                                        <input type="hidden" name="idCliente" value={{ $relatorioSaida->idCliente }}>
                                        <td><button type="submit" id="formVenda"
                                                class="btn btn-outline-primary ">{{ $relatorioSaida->planoPagamento }}</button>
                                        </td>
                                    </form>
                                    <td>{{ $relatorioSaida->quantidadeVendas }}</td>
                                @elseif (($relatorioSaidaSinteticos->tipo != 'plano'))
                                    <td>{{ $relatorioSaida->planoPagamento }}</td>
                                    <td>{{ $relatorioSaida->quantidadeVendas }}</td>
                                @endif
                                <td>{{ $relatorioSaida->TotalQtdItem }}</td>
                                <td>{{ $relatorioSaida->valorTotal }}</td>
                                <td>{{ $relatorioSaida->totalPago }}</td>

                            </tr>
                        @endif
                    @endforeach
                    <tr class="table-warning">
                        <th class="tdShow">Total Vendas:</th>
                        <td>{{ $relatorioSaidaSintetico->quantidadeVendas }}</td>
                    </tr>
                </tbody>
            </table>
        @else
            <h5>Não há vendas vinculados nesse Cliente</h5>
        @endif
    @endforeach
</div>
