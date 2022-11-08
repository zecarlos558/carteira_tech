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
        if ($request->data != null) {
            $data = $request->data;
        } else {
            $data = date('y-m-d');
        }

        $dadosRenda = Relatorio::consultaTotalRenda()
        ->whereMonth('data', '=', formatarData($data,'m'))
        ->first();
        $dadosGastos = Relatorio::consultaTotalGastos()
        ->whereMonth('data', '=', formatarData($data,'m'))
        ->first();

        $relatorio = new Relatorio;
        $relatorio->construtorSaida($dadosGastos);
        $relatorio->construtorEntrada($dadosRenda);
        $relatorio->construtorSaldo();

        $relatorioCategorias = Relatorio::consultaPorCategoria()
        ->whereMonth('data', '=', formatarData($data,'m'))
        ->get();

        $relatorio->calculaBarraCategorias($relatorioCategorias);

        return view('relatorios.index', ['relatorio' => $relatorio,
                                         'data' => $data,
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
        $data = date('y-m-d');
        $dadosRendaMensal = Relatorio::consultaTotalRenda()
        ->addSelect(DB::raw('EXTRACT(YEAR_MONTH FROM data) as mes_ano'))
        ->groupBy( DB::raw('EXTRACT(YEAR_MONTH FROM data)') )
        ->get();

        $dados = $request->all();
        $movimentos = Relatorio::consultaRenda();
        $dadosRenda = Relatorio::consultaTotalRenda();
        $relatorioCategorias = Relatorio::consultaPorCategoria();

        if ( count($dados) > 0 && $dados['opcao_data'] == 'personalizado') {
            $dados['dataInicio'] = $dados['dataInicio'].'-01';
            $dados['dataFim'] = $dados['dataFim'].'-30';
            $movimentos = $movimentos->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
            ->get();
            $dadosRenda = $dadosRenda->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
            ->first();
            $relatorioCategorias = $relatorioCategorias->where('tipo','suprimento')
            ->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
            ->get();
            $data = $dados;
        } else {
            if (isset($dados['opcao_data']) == 'mensal') {
                $data = $dados['data'];
            }
            $movimentos = $movimentos->whereMonth('data', '=', formatarData($data,'m'))
            ->get();
            $dadosRenda = $dadosRenda->whereMonth('data', '=', formatarData($data,'m'))
            ->first();
            $relatorioCategorias = $relatorioCategorias->where('tipo','suprimento')
            ->whereMonth('data', '=', formatarData($data,'m'))
            ->get();
        }

        // Preenche valores para chart Saida Percentual
        if (count($relatorioCategorias) > 0) {
            $arraySaida = array();
            foreach ($relatorioCategorias as $key => $consultaPlanosSaida) {
                $arraySaida['nomes'][$key] = $consultaPlanosSaida->nome;
                $arraySaida['percentual'][$key] = $consultaPlanosSaida->valorTotal;
            }
            $dadosChart['nomes'] = implode("|", $arraySaida['nomes']);
            $dadosChart['percentual'] = implode("|", $arraySaida['percentual']);
        } else {
            $dadosChart['nomes'] = null;
            $dadosChart['percentual'] = null;
        }
        // Preenche valores para chart Saidas por Mês
        if (count($dadosRendaMensal) > 0) {
            foreach ($dadosRendaMensal as $key => $progressoMensal) {
                $dataSaida = formata_year_month($progressoMensal->mes_ano);
                $arraySaida['valorTotal'][$key] = $progressoMensal->valorTotalEntrada;
                $arraySaida['mes'][$key] = $dataSaida['mes'].'/'.$dataSaida['ano'];
            }
            $dadosChart['valorTotal'] = implode("|", $arraySaida['valorTotal']);
            $dadosChart['mes'] = implode("|", $arraySaida['mes']);
        } else {
            $dadosChart['valorTotal'] = null;
            $dadosChart['mes'] = null;
        }

        $relatorio = new Relatorio;
        $relatorio->construtorEntrada($dadosRenda,'entrada');
        $relatorio->calculaBarraCategorias($relatorioCategorias);

        return view('relatorios.showRenda', ['data' => $data,
                                             'array' => $dadosChart,
                                             'movimentos' => $movimentos,
                                             'relatorioCategorias' => $relatorioCategorias])->render();

    }

    public function showGasto(Request $request)
    {
        $data = date('y-m-d');
        $dadosGastoMensal = Relatorio::consultaTotalGastos()
        ->addSelect(DB::raw('EXTRACT(YEAR_MONTH FROM data) as mes_ano'))
        ->groupBy( DB::raw('EXTRACT(YEAR_MONTH FROM data)') )
        ->get();

        $dados = $request->all();
        $movimentos = Relatorio::consultaGastos();
        $dadosGasto = Relatorio::consultaTotalGastos();
        $relatorioCategorias = Relatorio::consultaPorCategoria();

        if ( count($dados) > 0 && $dados['opcao_data'] == 'personalizado') {
            $dados['dataInicio'] = $dados['dataInicio'].'-01';
            $dados['dataFim'] = $dados['dataFim'].'-30';
            $movimentos = $movimentos ->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
            ->get();
            $dadosGasto = $dadosGasto->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
            ->first();
            $relatorioCategorias = $relatorioCategorias->where('tipo','retirada')
            ->whereBetween('data', [$dados['dataInicio'], $dados['dataFim']])
            ->get();
            $data = $dados;
        } else {
            if (isset($dados['opcao_data']) == 'mensal') {
                $data = $dados['data'];
            }
            $movimentos = $movimentos->whereMonth('data', '=', formatarData($data,'m'))
            ->get();
            $dadosGasto = $dadosGasto->whereMonth('data', '=', formatarData($data,'m'))
            ->first();
            $relatorioCategorias = $relatorioCategorias->where('tipo','retirada')
            ->whereMonth('data', '=', formatarData($data,'m'))
            ->get();
        }

        // Preenche valores para chart Saida Percentual
        if (count($relatorioCategorias) > 0) {
            $arraySaida = array();
            foreach ($relatorioCategorias as $key => $consultaPlanosSaida) {
                $arraySaida['nomes'][$key] = $consultaPlanosSaida->nome;
                $arraySaida['percentual'][$key] = $consultaPlanosSaida->valorTotal;
            }
            $dadosChart['nomes'] = implode("|", $arraySaida['nomes']);
            $dadosChart['percentual'] = implode("|", $arraySaida['percentual']);
        } else {
            $dadosChart['nomes'] = null;
            $dadosChart['percentual'] = null;
        }
        // Preenche valores para chart Saidas por Mês
        if (count($dadosGastoMensal) > 0) {
            foreach ($dadosGastoMensal as $key => $progressoMensal) {
                $dataSaida = formata_year_month($progressoMensal->mes_ano);
                $arraySaida['valorTotal'][$key] = $progressoMensal->valorTotalSaida;
                $arraySaida['mes'][$key] = $dataSaida['mes'].'/'.$dataSaida['ano'];
            }
            $dadosChart['valorTotal'] = implode("|", $arraySaida['valorTotal']);
            $dadosChart['mes'] = implode("|", $arraySaida['mes']);
        } else {
            $dadosChart['valorTotal'] = null;
            $dadosChart['mes'] = null;
        }

        $relatorio = new Relatorio;
        $relatorio->construtorSaida($dadosGasto,'saida');
        $relatorio->calculaBarraCategorias($relatorioCategorias);

        return view('relatorios.showGasto', ['data' => $data,
                                             'array' => $dadosChart,
                                             'movimentos' => $movimentos,
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
