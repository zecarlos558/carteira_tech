var calculaPagamento = false;
// Função Busca dado do select e exibe no input
// Função para selecionar tipo de plano na view createVenda
//onChange="tipoPlano2()" Para acionar função na View
function tipoPlano2(planos) {
    var select = document.getElementById('plano');
    var option = select.options[select.selectedIndex];
    opcao = option.value;
    var indice = select.selectedIndex-1;
    plano = planos[indice];
    //alert(plano);
    //document.getElementById('plano').value = opcao;
    // Verifica se não há plano selecionado para ativar botão
    if (opcao == '') {
        //document.getElementById('botaoParcelamento').style.display = 'none';
    } else {
        //document.getElementById('botaoParcelamento').style.display = 'block';
        document.getElementById("nomePlano").innerHTML = "Nome do Plano: "+plano['nome'];
        if (plano['descricao'] != null) {
            document.getElementById("descricaoPlano").innerHTML = "Descrição: "+plano['descricao'];
        }
        confereCheckboxPlano2(plano);
    }

    //inputPlanoParcelado(plano,valorCarrinho);
    /*
    var inputOutros = document.getElementById('parcelamento');
    if (plano['tipo'] === 'credito'){
        inputOutros.style.display = "block";
        dadosPlanoParcelado(plano,valorCarrinho);
    }
    else {
        inputOutros.style.display = "none";
        document.querySelector("#valorTotalPago").value = valorCarrinho;

    }
    */
    return option;
}


// Verifica tipo de plano para ativar parcelamento
function confereCheckboxPlano2(plano) {
    confirmaCartao = plano['nome'].toLowerCase().includes('cartao');
    confirmaCartão = plano['nome'].toLowerCase().includes('cartão');
    confirmaPIX = plano['nome'].toLowerCase().includes('pix');
    confirmaDinheiro = plano['nome'].toLowerCase().includes('dinheiro');
    calculaPagamento = false;
    limparResumoPagamento();
    resetaPagamentoEntrada();
    //alert("Cartão: "+confirmaCartao+" Cartão: "+confirmaCartão+" Dinheiro: "+confirmaDinheiro+" PIX: "+confirmaPIX);
    if (plano['tipo'] == 'credito') {
        //document.getElementById('botaoParcelamento').style.display = 'block';
        document.getElementById('confirmaParcelamento').style.display = 'block';
        document.getElementById('divQTDParcelas').style.display = 'block';
        //document.getElementById('divRadioEntrada').style.display = 'block';
        document.getElementById('divValorDinheiro').style.display = 'none';
    } else if (confirmaCartao==true || confirmaCartão==true) {
        document.getElementById('divQTDParcelas').style.display = 'block';
        //document.getElementById('divRadioEntrada').style.display = 'block';
        document.getElementById('divQTDParcelas').style.display = 'block';
        document.getElementById('divValorDinheiro').style.display = 'none';
        document.getElementById('confirmaParcelamento').style.display = 'none';
    } else if (confirmaDinheiro==true) {
        document.getElementById('divValorAcrescimo').style.display = 'none';
        //document.getElementById('inputValorPago').style.display = 'none';
        document.getElementById('divValorDinheiro').style.display = 'block';
        document.getElementById('divQTDParcelas').style.display = 'none';
        //document.getElementById('divRadioEntrada').style.display = 'none';
        document.getElementById('confirmaParcelamento').style.display = 'none';
    } else if (confirmaPIX == true) {
        document.getElementById('divQTDParcelas').style.display = 'none';
        //document.getElementById('divRadioEntrada').style.display = 'block';
        document.getElementById('divValorDinheiro').style.display = 'none';
        document.getElementById('confirmaParcelamento').style.display = 'none';
    } else {
        document.getElementById('botaoParcelamento').style.display = 'none';
        document.getElementById('divValorDinheiro').style.display = 'none';
        document.getElementById('confirmaParcelamento').style.display = 'none';
        document.getElementById('divValorAcrescimo').style.display = 'none';
        document.getElementById('inputValorPago').style.display = 'none';
        document.getElementById('divQTDParcelas').style.display = 'none';
        //document.getElementById('divRadioEntrada').style.display = 'none';
    }
    // Verifica e desabilita se botao de parcela esta selecionado nos planos debito
    if(document.getElementById('temParcela1').checked && plano['tipo'] == 'debito'){
        alert("Não é permitido parcelar no plano do tipo débito!");
        document.getElementById('temParcela1').checked = false;
        document.getElementById('temParcela0').checked = true;
        document.getElementById('confirmaParcelamento').style.display = 'none';
    }

}

function resetaPagamentoEntrada() {
    document.getElementById('radioEntradaSim').checked = false;
    document.getElementById('radioEntradaNao').checked = true;
    document.getElementById('divValorEntrada').style.display = 'none'
    document.querySelector("#valorPagamentoEntrada").value = "";
    // Verifica e desabilita radio valor de entrada
    if (document.getElementById('divRadioEntrada').style.display == 'none') {
        document.getElementById('divValorEntrada').style.display = 'none';
    }
}

function calcularParcela2() {
    calculaPagamento = true;
    valorCarrinho = document.getElementById("valorTotal");
    valorCarrinho = valorCarrinho.value;
    var select = document.getElementById('plano');
    var opcaoTexto = select.options[select.selectedIndex].text;
    var selectEntrada = document.getElementById('planoEntrada');
    var opcaoTextoEntrada = selectEntrada.options[selectEntrada.selectedIndex].text;
    confirmaDinheiro = opcaoTexto.toLowerCase().includes('dinheiro');
    confirmaPIX = plano['nome'].toLowerCase().includes('pix');
    valorCarrinho = parseFloat(valorCarrinho);
    valorPago = document.querySelector("#valorTotalPago").value;
    // Calcula Desconto
    if (valorCarrinho == valorPago || !(document.getElementById('radioDesconto').checked)) {
        valorDesconto = 0;
    } else {
        valorDesconto = (valorCarrinho - valorPago).toFixed(2);
    }
    percentualDesconto = ( (valorPago * 100) / valorCarrinho ).toFixed(2);
    // Verifica pagamento entrada
    valorPagamentoEntrada = document.querySelector("#valorPagamentoEntrada").value;
    valorPagamentoEntrada = parseFloat(valorPagamentoEntrada);
    if ( document.getElementById('radioEntradaSim').checked ) { // exemplo de verificar input vazio -- !(isNaN(valorPagamentoEntrada)) && (typeof valorPagamentoEntrada !== 'undefined')
        valorPago = valorPago - valorPagamentoEntrada;
        document.getElementById("valorEntrada").innerHTML = "Valor Entrada: "+valorPagamentoEntrada;
        document.getElementById("planoEntradaExibir").innerHTML = "Plano da Entrada: "+opcaoTextoEntrada;
    } else {
        document.getElementById("valorEntrada").innerHTML = "";
        document.getElementById("planoEntradaExibir").innerHTML = "";
    }
    // Verifica o tipo do plano e mostra resumo
    document.getElementById("valorTotalExibir").innerHTML = "Valor Total: "+valorCarrinho;
    document.getElementById("valorDesconto").innerHTML = "Valor de Desconto: "+valorDesconto+"R$";
    document.getElementById("valorFinal").innerHTML = "Valor Final: "+valorPago;
    if (confirmaDinheiro==true) {
        inputPlanoDinheiro(valorCarrinho)
    } else if (confirmaPIX==true) {
        inputPlanoPIX(valorCarrinho)
    } else {
        inputPlanoParcelado2(valorCarrinho)
    }

}

function inputPlanoDinheiro(valorCarrinho) {
    valorCarrinho = parseFloat(valorCarrinho);
    valorPagamentoDinheiro = document.querySelector("#valorPagamentoDinheiro").value;
    valorPagamentoDinheiro = parseFloat(valorPagamentoDinheiro);
    valorTroco = valorPagamentoDinheiro - valorPago;
    document.getElementById("valorTrocoDinheiro").innerHTML = "Valor de Troco: "+valorTroco.toFixed(2)+"R$";
}

function inputPlanoPIX(valorCarrinho) {

}

function inputPlanoParcelado2(valorCarrinho) {
    valorCarrinho = parseFloat(valorCarrinho);
    valorPago = parseFloat(document.querySelector("#valorTotalPago").value);
    document.getElementById('divParcela').style.display = 'block';
    dataParcela = document.querySelector("#dataParcela").value;
    //percentualAcrescimo = document.querySelector("#inputValorAcrescimo").value;
    percentualAcrescimo = document.querySelector("#acrescimo").value;
    valorAcrescimo = (percentualAcrescimo / 100) * valorCarrinho;
    qtdParcela = document.querySelector("#inputQtdParcela").value;
    document.getElementById("valorAcrescimo").innerHTML = "Valor Acréscimo: "+valorAcrescimo.toFixed(2)+"R$";
    document.getElementById("qtdParcela").innerHTML = "Quantidade Parcelas: "+qtdParcela;
    if (valorCarrinho != valorPago) {
        valorTotal = valorPago
    } else {
        valorTotal = ((((percentualAcrescimo) / 100) * valorCarrinho) + valorCarrinho).toFixed(2);
    }

    valorParcela = (valorTotal/qtdParcela).toFixed(2);
    var parcelamento = '';
    for (let index = 0; index < qtdParcela; index++) {
        if (document.getElementById('temParcela1').checked) {
            parcelamento = parcelamento+(index+1)+'° - '+add_mes(dataParcela, index)+': '+valorParcela+'R$<br>';
        } else {
            parcelamento = parcelamento+(index+1)+'° Parcela: '+valorParcela+'R$<br>';
        }

    }

    document.getElementById("valorParcela").innerHTML = parcelamento;
    document.getElementById("valorTotalParcelado").innerHTML = "Valor Total: "+valorTotal;
    document.querySelector("#valorTotalAcrescimo").value = valorTotal;
    document.getElementById('divValorAcrescimo').style.display = 'block';
    //document.getElementById('inputValorPago').style.display = 'block';
}

// Função copia valor do input valor parcelado para valor pago
function copiaParceladoValorPago2() {
    valorPagamentoEntrada = document.querySelector("#valorTotalAcrescimo").value;
    valorPagamentoEntrada = parseFloat(valorPagamentoEntrada);
    if ( !(isNaN(valorPagamentoEntrada)) && (typeof valorPagamentoEntrada !== 'undefined') ) {
        document.querySelector("#valorTotalPago").value = valorPagamentoEntrada;
    } else {
    }
}

// Verifica o radio de desconto/parcelamento para ativar função
function confereCheckboxEntrada() {
    if(document.getElementById('radioEntradaSim').checked){
        document.getElementById('divValorEntrada').style.display = 'block';
    } else {
        document.getElementById('divValorEntrada').style.display = 'none';
    }
}

// Verifica radio de valor de entrada
function confereCheckboxDescontoAcrescimo2() {
    if(document.getElementById('radioDesconto').checked){
        document.getElementById('enviar').style.display = 'block';
        document.getElementById('divDesconto').style.display = 'block';
        document.getElementById('divAcrescimo').style.display = 'none';
    } else {
        document.getElementById('enviar').style.display = 'none';
        document.getElementById('divDesconto').style.display = 'none';
        document.getElementById('divAcrescimo').style.display = 'block';
    }
}

// Função capturar valor do input de Desconto/Acrescimo
function CalculaDesconto2() {
    valorPago = document.querySelector("#valorTotal");
    resultado = document.querySelector("#valorTotalPago");
    valorPago = valorPago.value;
    desconto = document.querySelector("#desconto");
    desconto = desconto.value;
    calculaValorDesconto2(desconto,valorPago,resultado);

}

function CalculaAcrescimo2() {
    valorPago = document.querySelector("#valorTotal");
    resultado = document.querySelector("#valorTotalPago");
    valorPago = valorPago.value;
    acrescimo = document.querySelector("#acrescimo");
    acrescimo = acrescimo.value;
    calculaValorAcrescimo2(acrescimo,valorPago,resultado);
}

function arredondar2(n) {
    return (Math.round(n * 100) / 100).toFixed(2);
}

function calculaValorDesconto2(desconto,valor,resultado){
    if (desconto === "") {

    } else {
        var valorDesconto = (parseFloat(desconto)/100) * parseFloat(valor);
        resultado.value = arredondar2(parseFloat(valor) - valorDesconto);
    }
};

function calculaValorAcrescimo2(acrescimo,valor,resultado){
    if (acrescimo === "") {

    } else {
        var valorAcrescimo = (parseFloat(acrescimo)/100) * parseFloat(valor);
        resultado.value = arredondar2(parseFloat(valor) + valorAcrescimo);
    }
};

function confereCheckboxTemParcela2() {
    if(document.getElementById('temParcela1').checked){
        document.getElementById('divDataParcela').style.display = 'block';
    } else {
        document.getElementById('divDataParcela').style.display = 'none';
    }
}

function limparResumoPagamento() {
    document.getElementById("valorDesconto").innerHTML = "";
    document.getElementById("valorPagoDinheiro").innerHTML = "";
    document.getElementById("valorTrocoDinheiro").innerHTML = "";
    document.getElementById("valorEntrada").innerHTML = "";
    document.getElementById("planoEntradaExibir").innerHTML = "";
    document.getElementById("valorTotalExibir").innerHTML = "";
    document.getElementById("valorFinal").innerHTML = "";
    document.getElementById("valorParcela").innerHTML = "";
    document.getElementById("valorTotalParcelado").innerHTML = "";
    document.getElementById("valorAcrescimo").innerHTML = "";
    document.getElementById("qtdParcela").innerHTML = "";
    document.getElementById('divParcela').style.display = 'none';
}

function verificaCalculaPagamento(element) {
    // Verifica clique botao javascript
    /*
    const element = document.querySelector('#calculaParcela')
    element.addEventListener('click', event => {
        console.log(event.target)
    })
    */
   if (calculaPagamento == false) {
    $("#storeVenda").submit(function(event){
        event.preventDefault();
    });
    $("#storeEntrada").submit(function(event){
        event.preventDefault();
    });
    alert("Não foi calculado corretamente o pagamento!");
    location.reload();
   } else {
   }
}

function verificaDestroyEdit(element) {
    $("#storeVenda").submit(function(event){
        event.preventDefault();
    });
    $("#storeEntrada").submit(function(event){
        event.preventDefault();
    });
    $("#destroyEdit").submit();
}
