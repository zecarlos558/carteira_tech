<div>
    <div class="container">
        <div class="row" id="isa-container">
            <div id="parcelamentoInfo" class="col border">
                <h3 id="nomePlano"></h3>
                <p id="descricaoPlano"></p>
                <div class="row">
                    <div class="col">
                        <label for="valorTotalPago">Valor Total Pago:</label>
                        <x-input.number id="valorTotalPago" name="valorTotalPago"></x-input.number>
                        <button type="button" style='display:none' class="btn btn-primary" id="inputValorPago" onclick="copiaParceladoValorPago()" >Valor Parcelado</button>
                    </div>

                    <div class="col">
                        <label for="valorTotal">Valor do Carrinho:</label>
                        <input class="form-control" value="" id="valorTotal" readonly name="valorTotal" type="number" >
                    </div>
                </div>
                <div class="mb-3 mt-3 " id="divValorAcrescimo" style='display:none'>
                    <label for="valorTotalAcrescimo">Valor Total Parcelado</label>
                    <div class="input-group">
                        <input class="form-control" value="" min="0" step="0.01" id="valorTotalAcrescimo" name="valorTotalAcrescimo" type="number" readonly>
                        <input type="button" class="btn btn-primary" onclick="copiaParceladoValorPago2()" value="Copiar Valor">
                    </div>
                </div>
                <div>
                    <div class="form-check-inline">
                        <input type="radio" class="form-check-input" id="radioDesconto" name="radioDesconto" value="desconto" onclick="return confereCheckboxDescontoAcrescimo2()" checked>
                        <label class="form-check-label" for="radioDesconto">Desconto</label>
                    </div>
                    <div class="form-check-inline">
                        <input type="radio" class="form-check-input" id="radioAcrescimo" name="radioDesconto" value="acrescimo" onclick="return confereCheckboxDescontoAcrescimo2()">
                        <label class="form-check-label" for="radioAcrescimo">Acréscimo</label>
                    </div>

                    <div id="divDesconto" class="form form-inline">
                        <label for="desconto">Desconto</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="desconto" placeholder="Desconto" name="desconto">
                            <input type="button" class="btn btn-primary" id="enviar" onclick="CalculaDesconto2()" value="Calcular">
                        </div>
                    </div>
                    <div style="display:none" id="divAcrescimo" class="form form-inline">
                        <label for="acrescimo">Acréscimo</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="acrescimo" placeholder="Acréscimo" name="acrescimo">
                            <input type="button" class="btn btn-primary" id="enviar" onclick="CalculaAcrescimo2()" value="Calcular">
                        </div>
                    </div>
                </div>
                <div>
                    <div id="divRadioEntrada" class="mb-3">
                        <label for="optradioEntrada">Tem Entrada</label>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" id="radioEntradaSim" name="optradioEntrada" value="sim" onclick="return confereCheckboxEntrada()">
                            <label class="form-check-label" for="radioEntradaSim">Sim</label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" id="radioEntradaNao" name="optradioEntrada" value="nao" onclick="return confereCheckboxEntrada()" checked>
                            <label class="form-check-label" for="radioEntradaNao">Não</label>
                        </div>
                    </div>
                    <div style='display:none' id="divValorEntrada" class="mb-3">
                        <x-label.label for="planoEntrada" class="form-label">Plano de Entrada</x-label.label>
                        <div class="input-group">
                            <x-label.span class="input-group-text" icon='plano'></x-label.span>
                            <x-input.select id="planoEntrada" name="planoEntrada">
                                <x-input.option value="" selected>Forma de pagamento</x-input.option>
                                @foreach ($planos as $plano)
                                    <x-input.option class="form-control" value="{{ $plano->id }}">{{ $plano->nome }}
                                    </x-input.option>
                                @endforeach
                            </x-input.select>
                        </div>
                        <label for="valorPagamentoEntrada">Valor de entrada:</label>
                        <input class="form-control" value="" id="valorPagamentoEntrada" name="valorPagamentoEntrada" type="number" >
                    </div>
                </div>
                <div style='display:none' id="divValorDinheiro" class="mb-3">
                    <label for="valorPagamentoDinheiro">Valor de Pagamento:</label>
                    <input class="form-control" value="" id="valorPagamentoDinheiro" name="valorPagamentoDinheiro" type="number" >
                </div>
                <div style='display:none' id="divQTDParcelas" class="mb-3">
                    <label for="inputQtdParcela">Quantidade Parcelas</label>
                    <input class="form-control" value="0" type="number" min="0" step="1" name="qtdParcela" id="inputQtdParcela">
                </div>
                <div style='display:none' id="confirmaParcelamento" class="mb-3">
                    <label for="">Confirma Parcelamento:</label>
                    <div class="form-check-inline">
                        <input type="radio" class="form-check-input" id="temParcela1" name="temParcela" value="1" onclick="return confereCheckboxTemParcela2()">
                        <label class="form-check-label" for="temParcela1">Sim</label>
                    </div>
                    <div class="form-check-inline">
                        <input type="radio" class="form-check-input" id="temParcela0" name="temParcela" value="0" onclick="return confereCheckboxTemParcela2()" checked>
                        <label class="form-check-label" for="temParcela0">Não</label>
                    </div>
                    <div style='display:none' id="divDataParcela" class="form-group">
                        <label for="dataParcela">Data da 1° Parcela</label>
                        <div class="input-group date">
                            <input type="date" id="dataParcela" name="dataParcela"
                                value="{{ date('Y-m-d') }}"
                                class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3 mt-3">
                    <button type="button" class="btn btn-success" id="calculaParcela" onclick="calcularParcela2()">Calcular Pagamento</button>
                </div>
            </div>
            <div class="col text-center text-uppercase border" id="parcelamentoQtd">
                <h3>Resumo do Pagamento:</h3>
                <div class="d-flex flex-wrap align-content-end justify-content-end">
                    <button type="button" class="btn btn-secondary" id="limparPagamento" onclick="limparResumoPagamento()">Limpar Resumo</button>
                </div>
                <hr>
                <div class=" mb-3 mt-3">
                    <h5 id="valorTotalExibir"></h5>
                    <h5 id="valorDesconto"></h5>
                    <h5 id="valorEntrada"></h5>
                    <h5 id="planoEntradaExibir"></h5>
                    <h5 id="valorFinal"></h5>
                    <h5 id="valorPagoDinheiro"></h5>
                    <h5 id="valorTrocoDinheiro"></h5>
                    <div style="display:none;" id="divParcela">
                    <hr>
                    <h5 id="qtdParcela"></h5>
                    <h5 id="valorAcrescimo"></h5>
                    <h5 id="valorParcela"></h5>
                    <h5 id="valorTotalParcelado"></h5>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{--
        Função para buscar dados de parcelamento pelo plano
    <div>
        <div class="container">
            <div class="row">
                <div id="parcelamentoInfo" class="col">
                    <h6 id="nomePlano"></h6>
                    <p id="qtdParcela"></p>
                    <p id="valorAcrescimo"></p>
                    <p id="descricaoPlano"></p>
                    <p>Valor Total do Carrinho: {{ $totalCarrinho }}</p>
                </div>
                <div id="parcelamentoQtd" class="col">
                    <p id="valorParcela"></p>
                    <p id="valorTotalParcelado"></p>
                </div>
            </div>
        </div>
    </div>

    --}}

</div>
