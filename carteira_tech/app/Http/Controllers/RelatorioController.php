<?php

namespace App\Http\Controllers;

use App\Models\Aplication;
use App\Models\Relatorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parametros = $request->except("_token");
        $parametros['data'] = $request->data ?? date('Y-m-d');
        $parametros["opcao_data"] = $request->opcao_data ?? "mensal";
        if ($parametros["opcao_data"] == "personalizado") {
            $parametros['dataInicio'] = $parametros['dataInicio'].'-01';
            $parametros['dataFim'] = date($parametros['dataFim'].'-t');
        }

        $dadosRenda = Relatorio::consultaTotalRenda()
        ->lancamentoEntreContas()
        ->when($parametros["opcao_data"] == "mensal", function ($query) use($parametros) {
            $query->whereMonth('data', '=', formatarData($parametros['data'],'m'))
            ->whereYear('data', '=', formatarData($parametros['data'],'Y'));
        })
        ->when($parametros["opcao_data"] == "personalizado", function ($query) use($parametros) {
            $query->whereBetween('data', [$parametros['dataInicio'], $parametros['dataFim']]);
        })
        ->first();
        $dadosGastos = Relatorio::consultaTotalGastos()
        ->lancamentoEntreContas()
        ->when($parametros["opcao_data"] == "mensal", function ($query) use($parametros) {
            $query->whereMonth('data', '=', formatarData($parametros['data'],'m'))
            ->whereYear('data', '=', formatarData($parametros['data'],'Y'));
        })
        ->when($parametros["opcao_data"] == "personalizado", function ($query) use($parametros) {
            $query->whereBetween('data', [$parametros['dataInicio'], $parametros['dataFim']]);
        })
        ->first();

        $relatorio = new Relatorio;
        $relatorio->setValorSaida($dadosGastos);
        $relatorio->setValorEntrada($dadosRenda);
        $relatorio->setValorSaldo();

        $relatorioCategorias = Relatorio::consultaPorCategoria()
        ->when($parametros["opcao_data"] == "mensal", function ($query) use($parametros) {
            $query->whereMonth('data', '=', formatarData($parametros['data'],'m'))
            ->whereYear('data', '=', formatarData($parametros['data'],'Y'));
        })
        ->when($parametros["opcao_data"] == "personalizado", function ($query) use($parametros) {
            $query->whereBetween('data', [$parametros['dataInicio'], $parametros['dataFim']]);
        })
        ->get()->sortByDesc("valorTotal");

        $relatorio->calculaBarraCategorias($relatorioCategorias);
        $parametros['desc_data'] = formataDataRelatorio($parametros);

        return view('relatorios.index', ['relatorio' => $relatorio,
                                         'parametros' => $parametros,
                                         'relatorioCategorias' => $relatorioCategorias])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function showRenda(Request $request)
    {
        if ($request->data != null) {
            $data = formatarData($request->data, 'Y-m-d');
        } else {
            $data = date('Y-m-d');
        }
        $dadosRendaMensal = Relatorio::consultaTotalRenda()
        ->addSelect(DB::raw("EXTRACT(YEAR_MONTH FROM data) as mes_ano"))
        ->groupBy( DB::raw("EXTRACT(YEAR_MONTH FROM data)") )
        ->orderBy('data', 'desc')
        ->get();

        $dados = $request->all(['data', 'opcao_data', 'dataInicio', 'dataFim']);
        $movimentos = Relatorio::consultaRenda();
        $dadosRenda = Relatorio::consultaTotalRenda();
        $relatorioCategorias = Relatorio::consultaPorCategoria();

        if ( count($dados) > 0 && @$dados['opcao_data'] == 'personalizado') {
            $dados['dataInicio'] = $dados['dataInicio'].'-01';
            $dados['dataFim'] = date($dados['dataFim'].'-t');
            $movimentos = $movimentos->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
            ->orderBy("data", "desc")
            ->get();
            $dadosRenda = $dadosRenda->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
            ->first();
            $relatorioCategorias = $relatorioCategorias->suprimento()
            ->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
            ->get()->sortByDesc("valorTotal");
            $data = $dados;
        } else {
            if (isset($dados['opcao_data']) && $dados['opcao_data'] == 'mensal') {
                $data = $dados['data'];
            } else {
                $dados['opcao_data'] = "mensal";
            }
            $movimentos = $movimentos->whereMonth('data', '=', formatarData($data,'m'))
            ->whereYear('data', '=', formatarData($data,'Y'))
            ->orderBy("data", "desc")
            ->get();
            $dadosRenda = $dadosRenda->whereMonth('data', '=', formatarData($data,'m'))
            ->whereYear('data', '=', formatarData($data,'Y'))
            ->first();
            $relatorioCategorias = $relatorioCategorias->suprimento()
            ->whereMonth('data', '=', formatarData($data,'m'))
            ->whereYear('data', '=', formatarData($data,'Y'))
            ->get()->sortByDesc("valorTotal");
        }
        $dados['desc_data'] = formataDataRelatorio($dados);

        $dadosRendaMensal->map(function ($dado) {
            $data = formata_year_month($dado->mes_ano);
            $dado->mes_ano = $data['mes'].'/'.$data['ano'];
        });
        // Preenche valores para chart Saida Percentual
        $dadosChart['doughnut'] = $relatorioCategorias->pluck("valorTotal", "nome");
        // Preenche valores para chart Saidas por Mês
        $dadosChart['bar'] = $dadosRendaMensal->pluck("valorTotal", "mes_ano");

        $relatorio = new Relatorio;
        $relatorio->setTipo('suprimento');
        $relatorio->setValorEntrada($dadosRenda,'entrada');
        $relatorio->calculaBarraCategorias($relatorioCategorias);

        return view('relatorios.showRenda', ['parametros' => $dados,
                                             'array' => $dadosChart,
                                             'movimentos' => $movimentos,
                                             'relatorio' => $relatorio,
                                             'relatorioCategorias' => $relatorioCategorias])->render();

    }

    public function showGasto(Request $request)
    {
        if ($request->data != null) {
            $data = formatarData($request->data, 'Y-m-d');
        } else {
            $data = date('Y-m-d');
        }
        $dadosGastoMensal = Relatorio::consultaTotalGastos()
        ->addSelect(DB::raw('EXTRACT(YEAR_MONTH FROM data) as mes_ano'))
        ->groupBy( DB::raw('EXTRACT(YEAR_MONTH FROM data)') )
        ->orderBy('data', 'desc')
        ->get();

        $dados = $request->all(['data', 'opcao_data', 'dataInicio', 'dataFim']);
        $movimentos = Relatorio::consultaGastos();
        $dadosGasto = Relatorio::consultaTotalGastos();
        $relatorioCategorias = Relatorio::consultaPorCategoria();

        if ( count($dados) > 0 && @$dados['opcao_data'] == 'personalizado') {
            $dados['dataInicio'] = $dados['dataInicio'].'-01';
            $dados['dataFim'] = date($dados['dataFim'].'-t');
            $movimentos = $movimentos->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
            ->orderBy("data", "desc")
            ->get();
            $dadosGasto = $dadosGasto->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
            ->first();
            $relatorioCategorias = $relatorioCategorias->retirada()
            ->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
            ->get()->sortByDesc("valorTotal");
            $data = $dados;
        } else {
            if (isset($dados['opcao_data']) && $dados['opcao_data'] == 'mensal') {
                $data = $dados['data'];
            } else {
                $dados['opcao_data'] = "mensal";
            }
            $movimentos = $movimentos->whereMonth('data', '=', formatarData($data,'m'))
            ->whereYear('data', '=', formatarData($data,'Y'))
            ->orderBy("data", "desc")
            ->get();
            $dadosGasto = $dadosGasto->whereMonth('data', '=', formatarData($data,'m'))
            ->whereYear('data', '=', formatarData($data,'Y'))
            ->first();
            $relatorioCategorias = $relatorioCategorias->retirada()
            ->whereMonth('data', '=', formatarData($data,'m'))
            ->whereYear('data', '=', formatarData($data,'Y'))
            ->get()->sortByDesc("valorTotal");
        }
        $dados['desc_data'] = formataDataRelatorio($dados);

        $dadosGastoMensal->map(function ($dado) {
            $data = formata_year_month($dado->mes_ano);
            $dado->mes_ano = $data['mes'].'/'.$data['ano'];
        });
        
        // Preenche valores para chart Saida Percentual
        $dadosChart['doughnut'] = $relatorioCategorias->pluck("valorTotal", "nome");
        // Preenche valores para chart Saidas por Mês
        $dadosChart['bar'] = $dadosGastoMensal->pluck("valorTotal", "mes_ano");

        $relatorio = new Relatorio;
        $relatorio->setTipo('retirada');
        $relatorio->setValorSaida($dadosGasto,'saida');
        $relatorio->calculaBarraCategorias($relatorioCategorias);

        return view('relatorios.showGasto', ['parametros' => $dados,
                                             'array' => $dadosChart,
                                             'movimentos' => $movimentos,
                                             'relatorio' => $relatorio,
                                             'relatorioCategorias' => $relatorioCategorias])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
