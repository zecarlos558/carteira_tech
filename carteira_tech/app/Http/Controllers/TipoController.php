<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoRequest;
use App\Models\Aplication;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dados = $request->all();
        $tipos = Tipo::filtroIndex($dados);

        return view('tipos.tipo', ['tipos' => $tipos])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipos.createTipo')->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoRequest $request)
    {
        $tipo = new Tipo();
        $tipo->nome = $request->nome;
        $tipo->user_id_create = Aplication::consultaIDUsuario();
        $tipo->user_id_update = Aplication::consultaIDUsuario();
        try {
            $tipo->save();
        } catch (\Exception $e) {
            Log::channel('main')->error($e->getMessage());
            return redirect()->route('createTipo')->with('msg_alert','Campos Inseridos invalidos!');
        }
        return redirect()->route('indexTipo')->with('msg_alert','Tipo Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo = Tipo::findOrFail($id);

        return view('tipos.showTipo', ['tipo' => $tipo])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo = Tipo::findOrFail($id);
        if ($tipo->user_id_create != Aplication::consultaIDUsuario()) {
            return abort(401);
        }

        return view('tipos.editTipo', ['tipo' => $tipo])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoRequest $request, $id)
    {
        $tipo = Tipo::findOrFail($id);
        if ($tipo->user_id_create != Aplication::consultaIDUsuario()) {
            return abort(401);
        }
        $tipo->nome = $request->nome;
        $tipo->user_id_update = Aplication::consultaIDUsuario();
        try {
            $tipo->save();
        } catch (\Exception $e) {
            Log::channel('main')->error($e->getMessage());
            return redirect()->route('editTipo')->with('msg_alert','Campos Inseridos invalidos!');
        }
        return redirect()->route('indexTipo')->with('msg_alert','Tipo Cadastrado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo = Tipo::findOrFail($id);
        if ($tipo->user_id_create != Aplication::consultaIDUsuario()) {
            return abort(401);
        }
        $tipo->delete();
        return redirect()->route('indexTipo')->with('msg_alert','Tipo deletado com sucesso!');
    }
}
