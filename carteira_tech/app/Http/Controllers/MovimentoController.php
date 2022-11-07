<?php

namespace App\Http\Controllers;

use App\Models\Aplication;
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
    public function index()
    {
        $data = date('d-m-y');

        $usuario = Aplication::consultaIDUsuario();
        $movimentos = Movimento::where('user_id_create',$usuario)
        ->whereMonth('data', '=', formatarData($data,'m'))
        ->select(DB::raw("(IF(tipo = 'suprimento', +valor, -valor)) AS total,
                            id, nome, valor, tipo, data"))
        ->get();

        $listaNomes = Movimento::where('user_id_create',$usuario)->select('id','nome','valor')->get();

        return view('movimentos.movimento', ['movimentos' => $movimentos,
                                             'listaNomes' => $listaNomes,
                                             'data' => $data])->render();
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
