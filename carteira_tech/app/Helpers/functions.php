<?php

    function verificaCountObjeto($objeto,$search = null)
    {
        if (count( (array) $objeto) == 0 & $search == null) {
           echo "Não há registros disponíveis!".$search;
        } elseif(count( (array) $objeto) == 0 & $search != "") {
            echo "Não há registros para essa busca '".$search."' !";
        } elseif (count($objeto) == 0) {
            echo "Não há registros para essa busca!";
        } else {
            # code...
        }
    }

    function checkDevice()
    {
        $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

        if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
            return true;
        } else {
            return false;
        }
    }

    function checkButton($valor)
    {
        $icons = array("criar","editar","deletar","filtrar");
        return (in_array($valor,$icons));
    }

    function formatarPermissoes($permissoes)
    {
        $textoPermissoes = "";
        foreach ($permissoes as $key => $permissao) {
            if (empty($textoPermissoes)) {
                $textoPermissoes = $textoPermissoes."".$permissao;
            } else {
                $textoPermissoes = $textoPermissoes.", ".$permissao;
            }
        }
        return $textoPermissoes;
    }

    function formataNomeMenu($nome)
    {
        if (count ( explode(" ",$nome) ) == 1) {
            $nome = $nome[0];
        } else {
            $nome = strstr($nome, ' ', true)[0] . trim(strstr($nome, ' ')[1]) ;
        }
        return $nome;
    }

    function retornaMaiorPermissao($permissoes)
    {
        $maiorPermissao = '';
        if ( (in_array('super',$permissoes)) ) {
            $maiorPermissao = 'super';
        } elseif ( (!in_array('super',$permissoes)) && (in_array('admin',$permissoes)) ) {
            $maiorPermissao = 'admin';
        } else {
            $maiorPermissao = 'user';
        }
        return $maiorPermissao;
    }

    function retornaRole($role,$roles=['Super Admin','super','admin','manager','seller','user'])
    {
        $funcoes = [];
        foreach ($roles as $key => $value) {
            $funcoes[$key] = $value;
        }
        switch ($role) {
            case 'Super Admin':
                return $funcoes;
                break;
            default:
                return array_diff($funcoes, ['Super Admin']);
                break;
        }
    }

    function retornaArrayPermissoes($permissoes)
    {
        $tipoPermissao = array();
        foreach($permissoes as $permissao){
            array_push($tipoPermissao, $permissao);
        }
        return $tipoPermissao;
    }

    function formatarNumero($numero)
    {
        return number_format($numero, 2, '.','');
    }

    function formatoData($data, $formato = 'd/m/y H:i')
    {
        echo date($formato, strtotime($data));
    }

    function formatarData($data, $formato = 'd/m/y')
    {
        return date($formato, strtotime($data));
    }

    function formataDataRelatorio($data, $formato = 'd/m/y')
    {
        if (isset($data['dataInicio'])) {
            return formataMes(formatarData($data['dataInicio'],'m')).' de '.formatarData($data['dataInicio'],'y')
            . ' - '.
            formataMes(formatarData($data['dataFim'],'m')).' de '.formatarData($data['dataFim'],'y');
        } else {
            return formataMes(formatarData($data,'m')).' de '.formatarData($data,'Y');
        }

    }

    function removerAcentos($string){
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
    }

     function formataPesquisa($request)
    {
        if ($request) {
            $id = explode(" ", $request);
            $id = $id[0];
        } else {
            $id = null;
        }
        return $id;
    }

    function formatarConsulta($consultas)
    {
        $textoConsulta = "";
        foreach ($consultas as $key => $consulta) {
            if (empty($textoConsulta)) {
                $textoConsulta = $textoConsulta."".$consulta."";
            } else {
                $textoConsulta = $textoConsulta.", ".$consulta."";
            }
        }
        return $textoConsulta;
    }

    function divisaoZero($numero)
    {
        if ($numero == 0) {
            $numero = 1;
        }
        return $numero;
    }

    function exibeTipoPagamento($tipo)
    {
        if ($tipo == 'debito') {
            $texto = 'Á vista';
        } elseif ($tipo == 'credito') {
            $texto = 'A prazo';
        }
        echo $texto;
    }

    function exibirValorNulo($dado)
    {
        if ($dado != null && $dado !== 0) {
            $dado;
        } else {
            $dado = 0.00000001;
        }
        return $dado;
    }

    function maiorValorArray($array, $keyToSearch)
{
    $currentMax = NULL;
    foreach($array as $arr)
    {
        foreach($arr as $key => $value)
        {
            if ($key == $keyToSearch && ($value >= $currentMax))
            {
                $currentMax = $value;
            }
        }
    }
    return $currentMax;
}

    function somaChaveArray($array = null, $chave = null)
    {
        $soma = 0;
        foreach ($array as $key => $valor){
            $soma += $valor->$chave;
        }
        return $soma;
    }

    function formataMes($numeroMes)
    {
        $numeroMes = (int) $numeroMes;
        $mes = array('', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
        return $mes[$numeroMes];
    }

    function formata_year_month($data)
    {
        $dataString = (string) $data;
        $anoData = substr($dataString,0,4);
        $mesData = substr($dataString,4,6);
        $dataFormatada['mes'] = $mesData;
        $dataFormatada['ano'] = $anoData;
        return $dataFormatada;
    }

    function formataBooleano($booleano)
    {
        if ($booleano == 1) {
            echo 'Ativo';
        } elseif ($booleano == 0) {
            echo 'Inativo';
        }
    }

    function comparaDataAtual($data)
    {
        $dataAtual = date('Y-m-d');

        if (strtotime($data) > strtotime($dataAtual)) {
            return true;
        } else {
            return false;
        }
    }

    function espacoBranco($tamanho, $nome)
    {
        if ($nome == null) {
            $nome = '0';
        }
        $nome_completo = str_pad($nome, $tamanho,' ');

        return $nome_completo;
    }

    function designTXT()
    {
        return '___________________________________________________';
    }

    function designWhatsApp()
    {
        return '______________________________';
    }

    function buscaValorMatriz($arrays,$chave,$valor)
    {
        if (is_array($arrays)) {
            foreach ($arrays as $key => $array) {
                if ($array[$chave] == $valor) {
                    break;
                } else {
                    $array = array();
                }
            }
        } elseif(is_object($arrays)) {
            foreach ($arrays as $key => $array) {
                if ($array->{$chave} == $valor) {
                    $array = array($array);
                    break;
                } else {
                    $array = new stdClass;
                }
            }
        } else {

        }
        return $array;
    }


    function utf8_decoder($string)
    {
        try {
            $string_decode = mb_convert_encoding($string, 'ISO-8859-1', 'UTF-8');
        } catch (\Exception $e) {
            return "Erro na codificação da string: $string - " . $e->getMessage();
        }
        return $string_decode;
    }

    function isPaginator($collection) {
        if ($collection instanceof \Illuminate\Pagination\LengthAwarePaginator || 
            $collection instanceof \Illuminate\Pagination\AbstractPaginator || 
            $collection instanceof \Illuminate\Pagination\Paginator) {
            return true;
        } else {
            return false;
        }
    }

    function resolveOfsset($dados) {
        if (!is_array($dados)) {
            return $dados;
        } elseif (!is_null(request('offset'))) {
            $dados['offset'] = request('offset');
        } elseif (!is_null(request('offset_busca'))) {
            $dados['offset'] = request('offset_busca');
        } else {
            $dados['offset'] = session()->get('offset');
        }
        return $dados;
    }