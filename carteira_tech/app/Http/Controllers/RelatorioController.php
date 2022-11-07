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
    public function index()
    {
        $data = date('d-m-y');
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

    public function showRenda()
    {
        $data = date('d-m-y');
        $dadosRenda = Relatorio::consultaTotalRenda()
        ->whereMonth('data', '=', formatarData($data,'m'))
        ->addSelect(DB::raw('EXTRACT(YEAR_MONTH FROM data) as mes_ano'))
        ->groupBy( DB::raw('EXTRACT(YEAR_MONTH FROM data)') )
        ->get();
        $relatorioCategorias = Relatorio::consultaPorCategoria()
        ->where('tipo','suprimento')
        ->whereMonth('data', '=', formatarData($data,'m'))
        ->get();


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
        if (count($dadosRenda) > 0) {
            foreach ($dadosRenda as $key => $progressoMensal) {
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

        $movimentos = Relatorio::consultaRenda()
        ->whereMonth('data', '=', formatarData($data,'m'))
        ->get();

        $dadosRenda = Relatorio::consultaTotalRenda()
        ->whereMonth('data', '=', formatarData($data,'m'))
        ->first();

        $relatorio = new Relatorio;
        $relatorio->construtorEntrada($dadosRenda,'entrada');

        $relatorioCategorias = Relatorio::consultaPorCategoria()
        ->where('tipo','suprimento')
        ->whereMonth('data', '=', formatarData($data,'m'))
        ->get();

        $relatorio->calculaBarraCategorias($relatorioCategorias);

        return view('relatorios.showRenda', ['array' => $dadosChart,
                                             'movimentos' => $movimentos,
                                             'relatorioCategorias' => $relatorioCategorias])->render();

    }

    public function showGasto()
    {
        $data = date('d-m-y');
        $dadosGasto = Relatorio::consultaTotalGastos()
        ->whereMonth('data', '=', formatarData($data,'m'))
        ->addSelect(DB::raw('EXTRACT(YEAR_MONTH FROM data) as mes_ano'))
        ->groupBy( DB::raw('EXTRACT(YEAR_MONTH FROM data)') )
        ->get();
        $relatorioCategorias = Relatorio::consultaPorCategoria()
        ->where('tipo','suprimento')
        ->whereMonth('data', '=', formatarData($data,'m'))
        ->get();


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
        if (count($dadosGasto) > 0) {
            foreach ($dadosGasto as $key => $progressoMensal) {
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

        $movimentos = Relatorio::consultaGastos()
        ->whereMonth('data', '=', formatarData($data,'m'))
        ->get();

        $dadosGasto = Relatorio::consultaTotalGastos()
        ->whereMonth('data', '=', formatarData($data,'m'))
        ->first();

        $relatorio = new Relatorio;
        $relatorio->construtorSaida($dadosGasto,'saida');

        $relatorioCategorias = Relatorio::consultaPorCategoria()
        ->where('tipo','retirada')
        ->whereMonth('data', '=', formatarData($data,'m'))
        ->get();

        $relatorio->calculaBarraCategorias($relatorioCategorias);

        return view('relatorios.showGasto', ['array' => $dadosChart,
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
