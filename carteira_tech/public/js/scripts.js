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

// Funções para botão de adicionar transação na tela
function toggleFAB(fab){
	if(document.querySelector(fab).classList.contains('show')){
  	document.querySelector(fab).classList.remove('show');
  }else{
  	document.querySelector(fab).classList.add('show');
  }
}

document.querySelector('.fab .main').addEventListener('click', function(){
	toggleFAB('.fab');
});

document.querySelectorAll('.fab ul li button').forEach((item)=>{
	item.addEventListener('click', function(){
		toggleFAB('.fab');
	});
});

function FuncaoPesquisaTabela() {
    $(document).ready(function () {
        $("#inputPesquisa").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#tabelaItens_overflow #tabelaPesquisa tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
            $("#itens_show #tabelaPesquisa tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
}

function sanitizeJSON(unsanitized) {
    return unsanitized.replace(/\&quot;/g, "\"");
}