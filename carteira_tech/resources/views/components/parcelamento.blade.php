<div class="container">
    <div class="row">
        <div id="parcelamentoInfo" class="col">
            <h6 id="nomePlano"></h6>
            <p id="descricaoPlano"></p>
            <label for="valorCarrinho">Valor Total do Carrinho:</label>
            <input class="form-control" value="{{$totalCarrinho}}" id="valorCarrinho" name="valorCarrinho" type="number" >
            <label for="inputValorAcrescimo">Percentual de Acréscimo(%)</label>
            <input class="form-control" type="number" name="valorAcrescimo" id="inputValorAcrescimo">
            <label for="inputQtdParcela">Quantidade Parcelas</label>
            <input class="form-control" value="0" type="number" min="0" step="1" name="qtdParcela" id="inputQtdParcela">
            <label for="valorPagamentoEntrada">Valor de entrada:</label>
            <input class="form-control" value="" id="valorPagamentoEntrada" name="valorPagamentoEntrada" type="number" >
            <div style='display:none' id="confirmaParcelamento" class="mb-3">
                <label for="">Confirma Parcelamento:</label>
                <div class="form-check-inline">
                    <input type="radio" class="form-check-input" id="temParcela1" name="temParcela" value="1" onclick="return confereCheckboxTemParcela()">
                    <label class="form-check-label" for="temParcela1">Sim</label>
                </div>
                <div class="form-check-inline">
                    <input type="radio" class="form-check-input" id="temParcela0" name="temParcela" value="0" onclick="return confereCheckboxTemParcela()" checked>
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
            <button type="button" class="btn btn-success" id="calculaParcela" onclick="calcularParcela()">Calcular Parcela</button>
        </div>
        <div id="parcelamentoQtd" class="col">
            <h6>Resumo das Parcelas:</h6>
            <p id="qtdParcela"></p>
            <p id="valorAcrescimo"></p>
            <p id="valorParcela"></p>
            <p id="valorTotalParcelado"></p>
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
