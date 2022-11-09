<?php

namespace App\Http\Controllers;

use App\Models\Aplication;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dados = $request->all();
        $grupos = Grupo::filtroIndex($dados);
        $listaGrupos = Grupo::whereIn('user_id_create',[1,Aplication::consultaIDUsuario()])->select('id','nome')->get();

        return view('grupos.grupo', ['grupos' => $grupos,
                                     'listaGrupos' => $listaGrupos])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('grupos.createGrupo')->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grupo = new Grupo();
        $grupo->nome = $request->nome;
        $grupo->user_id_create = Aplication::consultaIDUsuario();
        $grupo->user_id_update = Aplication::consultaIDUsuario();
        try {
            $grupo->save();
        } catch (\Exception $e) {
            Log::channel('main')->error($e->getMessage());
            return redirect()->route('createGrupo')->with('msg_alert','Campos Inseridos invalidos!');
        }
        return redirect()->route('indexGrupo')->with('msg_alert','Grupo Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupo = Grupo::findOrFail($id);

        return view('grupos.showGrupo', ['grupo' => $grupo])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grupo = Grupo::findOrFail($id);

        return view('grupos.editGrupo', ['grupo' => $grupo])->render();
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
        $grupo = Grupo::findOrFail($id);
        $grupo->nome = $request->nome;
        $grupo->user_id_update = Aplication::consultaIDUsuario();
        try {
            $grupo->save();
        } catch (\Exception $e) {
            Log::channel('main')->error($e->getMessage());
            return redirect()->route('editGrupo')->with('msg_alert','Campos Inseridos invalidos!');
        }
        return redirect()->route('indexGrupo')->with('msg_alert','Grupo Cadastrado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Grupo::findOrFail($id)->delete();
        return redirect()->route('indexGrupo')->with('msg_alert','Grupo Deletado com sucesso!');
    }
}
