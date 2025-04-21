<?php

namespace App\Http\Controllers;

use App\Models\Aplication;
use App\Models\Categoria;
use App\Models\Conta;
use App\Models\Movimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dados = $request->all();
        if ($request->data == null) {
            $dados['data'] = date('Y-m-d');
        }
        $dados = resolveOfsset($dados);

        $movimentos = Movimento::filtroIndex($dados);
        $tipo_contas = Conta::with('tipos')->get()->groupBy('tipo.nome');
        $grupo_categorias = Categoria::with('grupos')->get()->groupBy('grupo.nome');

        return view('movimentos.movimento', ['movimentos' => $movimentos,
                                             'tipo_contas' => $tipo_contas,
                                             'grupo_categorias' => $grupo_categorias,
                                             'data' => $dados['data'],
                                             'offset' => $dados['offset']])->render();
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
