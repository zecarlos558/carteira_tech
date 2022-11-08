// Variáveis Globais
var data_atual = new Date();
var arrayProduto = [];

// Funções
function darkMode() {
    var element = document.body;
    element.classList.toggle("dark-mode");
    var elementHead = document.header;
    elementHead.classList.toggle("dark-head");
}

function selecionaObjeto(id,tipo) {
    //alert("/fornecedor/show/"+(id.rowIndex-1));
    location.href="http://localhost:8000/"+tipo+"/show/"+id.rowIndex;
};

function checkDevice() {
    if( navigator.userAgent.match(/Android/i)
    || navigator.userAgent.match(/webOS/i)
    || navigator.userAgent.match(/iPhone/i)
    || navigator.userAgent.match(/iPad/i)
    || navigator.userAgent.match(/iPod/i)
    || navigator.userAgent.match(/BlackBerry/i)
    || navigator.userAgent.match(/Windows Phone/i)
    ){
       return true; // está utilizando celular
     }
    else {
       return false; // não é celular
     }
}

// Setando o foco em um campo
function setFocus(id) {
    document.getElementById(id).focus();
  }

// Verifica função para exibir opções aos usuários
function verificaRole(funcao,funcoes) {
    funcao = JSON.parse(funcao);
    funcoes = JSON.parse(funcoes);
    funcao.forEach(role => {
        if (role['name'].search('read') != -1) {
            nome = role['name'].replaceAll('read ','');
        } else if (role['name'].search('create') != -1) {
            nome = role['name'].replaceAll('create ','');
        } else if (role['name'].search('edit') != -1) {
            nome = role['name'].replaceAll('edit ','');
        } else if (role['name'].search('delete') != -1) {
            nome = role['name'].replaceAll('delete ','');
        }
        if (nome == 'config') {
            nome = 'configuração';
            role['name'] = role['name'].replace('config','configuração');
        }
        if (funcoes.includes(nome)) {
            document.getElementById(role['name']).checked = true;
        }
    });

}

function selecionaData() {
    var select = document.getElementById('opcao_data');
    var option = select.options[select.selectedIndex];
    opcao = option.value;

    if (opcao == 'mensal') {
        document.getElementById('mensal').style.display = 'block';
        document.getElementById('personalizado').style.display = 'none';
    } else if(opcao == 'personalizado') {
        document.getElementById('mensal').style.display = 'none';
        document.getElementById('personalizado').style.display = 'block';
    }
}

function corSistema() {
    body_background = document.getElementById("body").value;
    body_text = document.getElementById("bodyText").value;
    head_background = document.getElementById("head").value;
    head_text = document.getElementById("headText").value;
    titulo_background = document.getElementById("titulo").value;
    titulo_text = document.getElementById("tituloText").value;

    document.body.style.backgroundColor  = body_background;
    document.body.style.color = body_text;
    document.getElementById("navbvarMenu").style.backgroundColor  = head_background;
    document.getElementById("navbvarMenu").style.color = head_text;
    document.getElementById("componentPanel").style.backgroundColor  = titulo_background;
    document.getElementById("componentPanel").style.color = titulo_text;
}

// função para limpar campos
function ClearFields() {
    document.getElementById("produto").value = "";
    document.getElementById("desconto").value = "";
    document.getElementById("descontoProduto").value = "";
    document.getElementById("quantidade").value = "";

    setFocus('produto');
}
// Função Busca dado do select e exibe no input
//onChange="update()" Para acionar função na View
function update() {
    var select = document.getElementById('language');
    var option = select.options[select.selectedIndex];

    document.getElementById('value').value = option.value;
    document.getElementById('text').value = option.text;
}

// Função Busca dado do select e exibe no input
// Função para selecionar tipo de plano na view createVenda
//onChange="tipoPlano()" Para acionar função na View
function tipoPlano(planos,valorCarrinho) {
    var select = document.getElementById('plano');
    var option = select.options[select.selectedIndex];
    opcao = option.value;
    var indice = select.selectedIndex-1;
    plano = planos[indice];
    //alert(plano);
    //document.getElementById('plano').value = opcao;
    // Verifica se não há plano selecionado para ativar botão
    if (opcao == '') {
        document.getElementById('botaoParcelamento').style.display = 'none';
    } else {
        document.getElementById('botaoParcelamento').style.display = 'block';
        document.getElementById("nomePlano").innerHTML = "Nome do Plano: "+plano['nome'];
        if (plano['descricao'] != null) {
            document.getElementById("descricaoPlano").innerHTML = "Descrição: "+plano['descricao'];
        }
        confereCheckboxPlano(plano);
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

// Se input igual a true pega valor do inputID
function retornaProduto(produtos) {
    /*
    var select = document.getElementById('produto');
    var option = select.options[select.selectedIndex];
    opcao = option.value;
    var indice = select.selectedIndex-1;
    */
    var input = document.querySelector("#produto");
    var texto = input.value;
    var indice = texto[0]-1;
    produto = produtos[indice];

    return produto;
}

// Função para preencher parcelas pelo plano
function dadosPlanoParcelado(plano,valorCarrinho) {
    document.getElementById("nomePlano").innerHTML = "Nome do Plano: "+plano['nome'];
    document.getElementById("valorAcrescimo").innerHTML = "Valor Acréscimo: "+plano['acrescimo'];
    document.getElementById("qtdParcela").innerHTML = "Quantidade Parcelas: "+plano['qtdParcelas'];
    document.getElementById("descricaoPlano").innerHTML = "Descrição: "+plano['descricao'];

    valorTotal = (((plano['acrescimo'] * plano['qtdParcelas'] / 100) * valorCarrinho) + valorCarrinho).toFixed(2);
    valorParcela = (valorTotal/plano['qtdParcelas']).toFixed(2);
    var parcelamento = '';
    for (let index = 0; index < plano['qtdParcelas']; index++) {
        parcelamento = parcelamento+(index+1)+'° Parcela: '+valorParcela+'<br>';

    }
    document.getElementById("valorParcela").innerHTML = parcelamento;
    document.getElementById("valorTotalParcelado").innerHTML = "Valor Total: "+valorTotal;
    document.querySelector("#valorTotalPago").value = valorTotal;
}
// Verifica tipo de plano para ativar parcelamento
function confereCheckboxPlano(plano) {
    if (plano['tipo'] == 'credito') {
        //document.getElementById('botaoParcelamento').style.display = 'block';
        document.getElementById('confirmaParcelamento').style.display = 'block';
    } else {
        //document.getElementById('botaoParcelamento').style.display = 'none';
        document.getElementById('confirmaParcelamento').style.display = 'none';
        document.getElementById('divValorAcrescimo').style.display = 'none';
        document.getElementById('inputValorPago').style.display = 'none';
    }

    if(document.getElementById('temParcela1').checked && plano['tipo'] == 'debito'){
        alert("Não é permitido parcelar no plano do tipo débito!");
        document.getElementById('temParcela1').checked = false;
        document.getElementById('temParcela0').checked = true;
    }
}

// Função para adicionar parcelas

function calcularParcela() {
    valorCarrinho = document.getElementById("valorCarrinho");
    valorCarrinho = valorCarrinho.value;
    inputPlanoParcelado(valorCarrinho);
}

function inputPlanoParcelado(valorCarrinho) {
    valorCarrinho = parseFloat(valorCarrinho);
    valorPagamentoEntrada = document.querySelector("#valorPagamentoEntrada").value;
    dataParcela = document.querySelector("#dataParcela").value;
    valorPagamentoEntrada = parseFloat(valorPagamentoEntrada);
    if ( !(isNaN(valorPagamentoEntrada)) && (typeof valorPagamentoEntrada !== 'undefined')) {
        valorCarrinho = valorCarrinho - valorPagamentoEntrada;
        document.querySelector("#valorTotalPago").value = valorPagamentoEntrada;
    } else {
        document.querySelector("#valorTotalPago").value = 0;
    }
    percentualAcrescimo = document.querySelector("#inputValorAcrescimo").value;
    valorAcrescimo = (percentualAcrescimo / 100) * valorCarrinho;
    qtdParcela = document.querySelector("#inputQtdParcela").value;
    document.getElementById("valorAcrescimo").innerHTML = "Valor Acréscimo: "+valorAcrescimo.toFixed(2)+"R$";
    document.getElementById("qtdParcela").innerHTML = "Quantidade Parcelas: "+qtdParcela;
    valorTotal = ((((percentualAcrescimo) / 100) * valorCarrinho) + valorCarrinho).toFixed(2);
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
    document.getElementById('inputValorPago').style.display = 'block';
}
// Função copia valor do input valor parcelado para valor pago
function copiaParceladoValorPago() {
    valorPagamentoEntrada = document.querySelector("#valorTotalAcrescimo").value;
    valorPagamentoEntrada = parseFloat(valorPagamentoEntrada);
    if ( !(isNaN(valorPagamentoEntrada)) && (typeof valorPagamentoEntrada !== 'undefined') ) {
        document.querySelector("#valorTotalPago").value = valorPagamentoEntrada;
    } else {
        document.querySelector("#valorTotalPago").value = 0;
    }
}

// Verifica o radio de desconto/parcelamento para ativar função
function confereCheckboxDescontoAcrescimo() {
    if(document.getElementById('radioDesconto').checked){
        document.getElementById('desconto').style.display = 'block';
        document.getElementById('acrescimo').style.display = 'none';
    } else {
        document.getElementById('desconto').style.display = 'none';
        document.getElementById('acrescimo').style.display = 'block';
    }
}

// Função capturar valor do input de Desconto/Acrescimo
function CalculaDescontoAcrescimo() {
    valorPago = document.querySelector("#valorTotalPago");
    resultado = document.querySelector("#valorTotalPago");
    valorPago = valorPago.value;
    if (document.getElementById('desconto').style.display != 'none') {
        desconto = document.querySelector("#desconto");
        desconto = desconto.value;
        calculaValorDesconto(desconto,valorPago,resultado);
    } else {
        acrescimo = document.querySelector("#acrescimo");
        acrescimo = acrescimo.value;
        calculaValorAcrescimo(acrescimo,valorPago,resultado);
    }
}

function arredondar(n) {
    return (Math.round(n * 100) / 100).toFixed(2);
}

function calculaValorDesconto(desconto,valor,resultado){
    if (desconto === "") {

    } else {
        var valorDesconto = (parseFloat(desconto)/100) * parseFloat(valor);
        resultado.value = arredondar(parseFloat(valor) - valorDesconto);
    }
};

function calculaValorAcrescimo(acrescimo,valor,resultado){
    if (acrescimo === "") {

    } else {
        var valorAcrescimo = (parseFloat(acrescimo)/100) * parseFloat(valor);
        resultado.value = arredondar(parseFloat(valor) + valorAcrescimo);
    }
};

function confereCheckboxTemParcela() {
    if(document.getElementById('temParcela1').checked){
        document.getElementById('divDataParcela').style.display = 'block';
    } else {
        document.getElementById('divDataParcela').style.display = 'none';
    }
}

// Retorna o mês com valor somado
function add_mes(data, add, formato = 'dd/mm/yyyy'){
	var arrData = data.split('-');
    data = new Date(arrData[0], arrData[1] - 1, arrData[2]);
    data.setMonth(data.getMonth() + add)
    return data.toLocaleDateString();
}

// Função Pesquisa Tabela (Presente no component centerSearch)

function FuncaoPesquisaTabela() {
    $(document).ready(function(){
        $("#inputPesquisa").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#tabelaPesquisa tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
}

  // Script com função de pesquisa lista do menu de opções
      function FuncaoPesquisaMenu() {
          var input, filter, ul, li, a, i;
          input = document.getElementById("pesquisaMenu");
          filter = input.value.toUpperCase();
          ul = document.getElementById("MenuOpcao");
          li = ul.getElementsByTagName("li");
          for (i = 0; i < li.length; i++) {
              a = li[i].getElementsByTagName("a")[0];
              if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
              li[i].style.display = "";
              } else {
              li[i].style.display = "none";
              }
          }
      }


    // Passar valor de um campo para outro (É chamado no modal editarValores no createVenda)

    function repeteValorOutroCampo(params) {
        $(document).ready(function(){
            $(".form-control").on("input", function(){
                var textoDigitado = $(this).val();
                var inputValor = $(this).attr("valorTotal");
                $("#"+ inputValor).val(textoDigitado);
            });
        });
    }

    //  Script com função de pesquisa na coluna da tabela
    function pesquisaColunaTabela() {
        $(function(){
            $("#tabela input").keyup(function(){
                var index = $(this).parent().index();
                var nth = "#tabela td:nth-child("+(index+1).toString()+")";
                var valor = $(this).val().toUpperCase();
                // Nessa linha exibe a tabela completa
                //$("#tabela tbody tr").show();
                $(nth).each(function(){
                    if($(this).text().toUpperCase().indexOf(valor) < 0){
                        $(this).parent().hide();
                    }
                });
                if (valor == "") {
                    $("#tabela tbody tr").show();
                }
            });


            /*// Nessas linha, programamos o evento blur dos inputs para que seu conteúdo seja limpo ao perderem o foco
            $("#tabela input").blur(function(){
                $(this).val("");
            });
            */
        });
    }

    // Script com função para limpar filtros e exibir tabela inteira
    function limpaFiltroTabela() {
        $("#tabela input").blur(function(){
            $(this).val("");
        });
        $("#tabela tbody tr").show();
        document.getElementById("txtColuna1").value = "";
        document.getElementById("txtColuna2").value = "";
        document.getElementById("txtColuna3").value = "";
        document.getElementById("txtColuna4").value = "";
        document.getElementById("txtColuna5").value = "";
        document.getElementById("txtColuna6").value = "";
    }

    // Script para mensagens de confirmação
    function mensagemAlerta() {
        //var msg = '{{Session::get('msg_alert')}}';
        //var exist = '{{Session::has('msg_alert')}}';
        if(exist){
          alert(msg);
        }
    }

    // Função para exibir senha ao clicar no olho checkbox
    function exibeSenha() {
        var x = document.getElementById("password");
        var span = document.querySelector("#olho");
        if (x.type === "password") {
          x.type = "text";
          span.setAttribute('icon','olho');
        } else {
          x.type = "password";
          span.setAttribute('icon','olhoFechado');
        }
    }

    // Função para exibir senha de confirmação ao clicar no olho checkbox
    function exibeSenha2() {
        var x = document.getElementById("password_confirmation");
        var span = document.querySelector("#olho2");
        if (x.type === "password") {
          x.type = "text";
          span.setAttribute('icon','olho');
        } else {
          x.type = "password";
          span.setAttribute('icon','olhoFechado');
        }
    }

    // Confere checkbox do status do produto(ativo/Inativo)
    function confereCheckbox() {

        if(document.getElementById('check1').checked){
            document.getElementById('check2').disabled = true;
        } else {
            document.getElementById('check2').disabled = false;
        }
        if(document.getElementById('check2').checked) {
            document.getElementById('check1').disabled = true;
        } else {
            document.getElementById('check1').disabled = false;
        }
    }

    //Funcao adiciona uma nova linha na tabela
    function adicionaLinha(idTabela,produtos) {

        var quantidade = document.getElementById('quantidade').value;
        if (quantidade=='' || quantidade==0) {
            quantidade = 1
        }
        var desconto = document.getElementById('descontoProduto').value;
        produto = retornaProduto(produtos);

        // Verifica se produto já está inserido no carrinho e adiciona quantidade
        var filtrado = arrayProduto.filter(function(obj) { return obj.idProduto == produto['id'] });
        if (filtrado != '') {
            const produtosTBL = document.getElementById('tbl');
            var tamanhoTbody = produtosTBL.childNodes[3].childNodes.length;
                // Índice 1 inicia os campos do td
                for (let i = 1; i < tamanhoTbody; i++) {
                                // Tabela[3] - TBODY     // TR      //TD[0] - NOME  // TEXTO
                    nomeTD = produtosTBL.childNodes[3].childNodes[i].childNodes[0].childNodes[0].nodeValue;

                    if (filtrado[0]['nome'] == nomeTD) {
                                        // Tabela[3] - TBODY     // TR      //TD[2] - QTD      // TEXTO
                        quantidadeTD = produtosTBL.childNodes[3].childNodes[i].childNodes[2].childNodes[0].nodeValue;
                        var quantidadeInput = document.getElementById('quantidade').value;
                        if (quantidadeInput == '') {
                            quantidadeTD = parseInt(quantidadeTD) + 1;
                        } else {
                            quantidadeTD = parseInt(quantidadeInput);
                        }
                        if (desconto=='') {
                            total = produto['precoSaida'] * quantidadeTD;
                        } else {
                            valorDesconto = (produto['precoSaida'] * quantidadeTD) * (desconto/100);
                            total = (produto['precoSaida'] * quantidadeTD) - valorDesconto;
                        }
                        produtosTBL.childNodes[3].childNodes[i].childNodes[2].innerHTML = quantidadeTD;
                        produtosTBL.childNodes[3].childNodes[i].childNodes[3].innerHTML = desconto;
                        produtosTBL.childNodes[3].childNodes[i].childNodes[4].innerHTML = total;
                        if (desconto == "") {
                            desconto=null;
                        }
                        arrayProduto[i-1]['quantidade'] = quantidadeTD;
                        arrayProduto[i-1]['desconto'] = desconto;
                        break;
                    }
                }

        // Se não adiciona novo produto
        } else if (!(typeof produto === "undefined")) {
            if (desconto=='' || desconto==0) {
                total = produto['precoSaida'] * quantidade
            } else {
                valorDesconto = (produto['precoSaida'] * quantidade) * (desconto/100)
                total = produto['precoSaida'] * quantidade - valorDesconto
            }
            var tabela = document.getElementById(idTabela);
            var numeroLinhas = tabela.rows.length; // numeroLinhas indica a última linha da tabela
            var linha = tabela.insertRow(1); // 1 indica para adicionar na primeira linha da tabela. Se não indica a última linha da tabela
            var celula1 = linha.insertCell(0);
            var celula2 = linha.insertCell(1);
            var celula3 = linha.insertCell(2);
            var celula4 = linha.insertCell(3);
            var celula5 = linha.insertCell(4);
            var celula6 = linha.insertCell(5);

            celula1.innerHTML = produto['nome'];
            celula2.innerHTML = produto['precoSaida'];
            celula3.innerHTML = quantidade;
            celula4.innerHTML = desconto;
            celula5.innerHTML = total;
            celula6.innerHTML =  "<button type='button' class='btn btn-danger' onclick='removeLinha(this)'>Remover</button>";
            if (desconto == "") {
                desconto=null;
            }
            arrayProduto.unshift({idProduto:produto['id'],nome:produto['nome'],quantidade:quantidade,desconto:desconto});
        } else {

        }

        if (document.body.contains(document.querySelector("#storeEntrada"))) {
            enviaDadosEntradaForm(JSON.stringify(arrayProduto));
        } else if (document.body.contains(document.querySelector("#storeVenda"))) {
            enviaDadosForm(JSON.stringify(arrayProduto));
        }
        atualizaDadosCarrinho();
        ClearFields();
    }

    // funcao remove uma linha da tabela
    function removeLinha(linha) {
        var i=linha.parentNode.parentNode.rowIndex;
        arrayProduto.splice(i-1, 1);
        document.getElementById('tbl').deleteRow(i);
        if (document.body.contains(document.querySelector("#storeEntrada"))) {
            enviaDadosEntradaForm(JSON.stringify(arrayProduto));
        } else if (document.body.contains(document.querySelector("#storeVenda"))) {
            enviaDadosForm(JSON.stringify(arrayProduto));
        }
        atualizaDadosCarrinho();
        ClearFields();
    }

    function preencheTabela(idTabela,carrinho,produtos) {
        document.querySelector("#arrayProduto").value = (carrinho);
        carrinho = JSON.parse(carrinho);
        produtos = JSON.parse(produtos);
        var tabela = document.getElementById(idTabela);
        //var numeroLinhas = tabela.rows.length; // numeroLinhas indica a última linha da tabela
        for (let index = 0; index < carrinho.length; index++) {
            //produto = retornaProduto(produtos);
            produto = produtos[(carrinho[index].idProduto)-1];
            var linha = tabela.insertRow(1); // 1 indica para adicionar na primeira linha da tabela. Se não indica a última linha da tabela
            var celula1 = linha.insertCell(0);
            var celula2 = linha.insertCell(1);
            var celula3 = linha.insertCell(2);
            var celula4 = linha.insertCell(3);
            var celula5 = linha.insertCell(4);
            var celula6 = linha.insertCell(5);

            celula1.innerHTML = produto.nome;
            celula2.innerHTML = produto.precoSaida;
            celula3.innerHTML = carrinho[index].quantidade;
            celula4.innerHTML = carrinho[index].desconto;
            if (carrinho[index].desconto == '') {
                total = produto.precoSaida * carrinho[index].quantidade;
            } else {
                valorDesconto = (produto.precoSaida * carrinho[index].quantidade) * (carrinho[index].desconto/100);
                total = (produto.precoSaida * carrinho[index].quantidade) - valorDesconto;
            }
            celula5.innerHTML = total;
            celula6.innerHTML =  "<button type='button' class='btn btn-danger' onclick='removeLinha(this)'>Remover</button>";
            if (carrinho[index].desconto == "") {
                desconto=null;
            }
            arrayProduto.unshift({idProduto:carrinho[index].idProduto,nome:carrinho[index].nome,quantidade:carrinho[index].quantidade,desconto:carrinho[index].desconto})
        }
        atualizaDadosCarrinho();
    }

    function preencheValorPagamento(totalCarrinho) {
        document.querySelector("#valorTotalPago").value = totalCarrinho;
        document.querySelector("#valorTotal").value = totalCarrinho;
        document.querySelector("#valorTotalAcrescimo").value = totalCarrinho;
        document.querySelector("#valorTotalEditado").value = totalCarrinho;
        document.querySelector("#valorTotalPagoModal").value = totalCarrinho;
    }

    function atualizaDadosCarrinho() {
        var produtosTBL = document.getElementById('tbl');
        quantidadeTD = 0;
        tamanhoTbody = 0;
        totalCarrinho = 0;
        if (produtosTBL.childNodes[3].childNodes.length === undefined) {

        } else if (arrayProduto == '') {
            var tamanhoTbody = (produtosTBL.childNodes[3].childNodes.length) - 2;
            for (let index = tamanhoTbody; index > 0; index--) {
                document.getElementById('tbl').deleteRow(index);
            }
            tamanhoTbody = 0;
        } else {
            var tamanhoTbody = (produtosTBL.childNodes[3].childNodes.length) - 1;
            totalCarrinho = 0
            for (let index = 1; index < tamanhoTbody; index++) {
                quantidadeTD = quantidadeTD + parseFloat(produtosTBL.childNodes[3].childNodes[index].childNodes[2].childNodes[0].nodeValue);
                totalCarrinho = totalCarrinho + parseFloat(produtosTBL.childNodes[3].childNodes[index].childNodes[4].childNodes[0].nodeValue);
            }
            tamanhoTbody = tamanhoTbody - 1;
        }
        document.getElementById("qtdProduto").innerHTML = "QTD Produtos: "+tamanhoTbody;
        document.getElementById("qtdItem").innerHTML = "QTD Itens: "+quantidadeTD;
        document.getElementById("totalCarrinho").innerHTML = "Total: "+totalCarrinho;
        preencheValorPagamento(totalCarrinho);
        document.querySelector("#arrayProduto").value = JSON.stringify(arrayProduto);

    }

    function enviaDadosForm(dados) {
        temID = document.body.contains(document.querySelector("#idVenda"))
        if (temID == false) {
            $.ajax({
                url: "http://localhost:8000/carrinho/recebe",
                type: 'POST',
                data: {
                    "_token": $('#token').val(),
                    data: dados
                },
                success: function(result){
                  // Retorno se tudo ocorreu normalmente
                  //alert("Deu certo! "+result)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  // Retorno caso algum erro ocorra
                  alert("Deu errado! "+textStatus+" | "+errorThrown+" | "+jqXHR);
                }
            });
        } else {
            idVenda = document.querySelector("#idVenda").value;
            $.ajax({
                url: "http://localhost:8000/carrinho/recebeEdit",
                type: 'POST',
                data: {
                    "_token": $('#token').val(),
                    data: dados,
                    idVenda
                },
                success: function(result){
                  // Retorno se tudo ocorreu normalmente
                  //alert("Deu certo! "+result)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  // Retorno caso algum erro ocorra
                  alert("Deu errado! "+textStatus+" | "+errorThrown+" | "+jqXHR);
                }
            });
        }


    }

    function enviaDadosEntradaForm(dados) {
        temID = document.body.contains(document.querySelector("#idEntrada"))
        if (temID == false) {
            $.ajax({
                url: "http://localhost:8000/carrinhoEntrada/recebe",
                type: 'POST',
                data: {
                    "_token": $('#token').val(),
                    data: dados
                },
                success: function(result){
                  // Retorno se tudo ocorreu normalmente
                  //alert("Deu certo! "+result)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  // Retorno caso algum erro ocorra
                  alert("Deu errado! "+textStatus+" | "+errorThrown+" | "+jqXHR);
                }
            });
        } else {
            idEntrada = document.querySelector("#idEntrada").value;
            $.ajax({
                url: "http://localhost:8000/carrinhoEntrada/recebeEdit",
                type: 'POST',
                data: {
                    "_token": $('#token').val(),
                    data: dados,
                    idEntrada
                },
                success: function(result){
                  // Retorno se tudo ocorreu normalmente
                  //alert("Deu certo! "+result)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  // Retorno caso algum erro ocorra
                  alert("Deu errado! "+textStatus+" | "+errorThrown+" | "+jqXHR);
                }
            });
        }
    }

    function limpaDados() {
        if (document.body.contains(document.querySelector("#storeEntrada"))) {
            limpaDadosCarrinhoEntrada();
        } else if (document.body.contains(document.querySelector("#storeVenda"))) {
            limpaDadosCarrinho();
        }
        arrayProduto = [];
        atualizaDadosCarrinho();
        ClearFields();
    }

    function limpaDadosCarrinho() {
        $.ajax({
            url: "http://localhost:8000/carrinho/limpa",
            type: 'POST',
            data: {
                "_token": $('#token').val()
            },
            success: function(result){
              // Retorno se tudo ocorreu normalmente
              //alert("Deu certo! "+result)
            },
            error: function(jqXHR, textStatus, errorThrown) {
              // Retorno caso algum erro ocorra
              alert("Deu errado! "+textStatus+" | "+errorThrown+" | "+jqXHR);
            }
        });
    }

    function limpaDadosCarrinhoEntrada() {
        $.ajax({
            url: "http://localhost:8000/carrinhoEntrada/limpa",
            type: 'POST',
            data: {
                "_token": $('#token').val()
            },
            success: function(result){
              // Retorno se tudo ocorreu normalmente
              //alert("Deu certo! "+result)
            },
            error: function(jqXHR, textStatus, errorThrown) {
              // Retorno caso algum erro ocorra
              alert("Deu errado! "+textStatus+" | "+errorThrown+" | "+jqXHR);
            }
        });
    }

