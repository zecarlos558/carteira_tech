<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Models\Aplication;
use App\Models\Categoria;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dados = $request->all();
        $dados = resolveOfsset($dados);
        $categorias = Categoria::filtroIndex($dados);
        $grupos = Grupo::all();

        return view('categorias.categoria', ['categorias' => $categorias,
                                             'grupos' => $grupos,
                                             'offset' => $dados['offset']])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupos = Grupo::all();

        return view('categorias.createCategoria', ['grupos' => $grupos])->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaRequest $request)
    {
        $categoria = new Categoria();
        $categoria->nome = $request->nome;
        $categoria->user_id_create = Aplication::consultaIDUsuario();
        $categoria->user_id_update = Aplication::consultaIDUsuario();
        try {
            $categoria->save();
        } catch (\Exception $e) {
            Log::channel('main')->error($e->getMessage());
            return redirect()->route('createCategoria')->with('msg_alert','Campos Inseridos invalidos!');
        }
        $categoria->grupos()->attach($request->grupo);
        return redirect()->route('indexCategoria')->with('msg_alert','Categoria cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('categorias.showCategoria', ['categoria' => $categoria])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        if ($categoria->user_id_create != Aplication::consultaIDUsuario()) {
            return abort(401);
        }
        $grupos = Grupo::all();

        return view('categorias.editCategoria', ['categoria' => $categoria,
                                                 'grupos' => $grupos])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaRequest $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        if ($categoria->user_id_create != Aplication::consultaIDUsuario()) {
            return abort(401);
        }
        $categoria->nome = $request->nome;
        $categoria->user_id_update = Aplication::consultaIDUsuario();
        try {
            $categoria->save();
        } catch (\Exception $e) {
            Log::channel('main')->error($e->getMessage());
            return redirect()->route('editCategoria')->with('msg_alert','Campos Inseridos invalidos!');
        }
        $categoria->grupos()->detach($categoria->grupos[0]->id);
        $categoria->grupos()->attach($request->grupo);
        return redirect()->route('indexCategoria')->with('msg_alert','Categoria editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        if ($categoria->user_id_create != Aplication::consultaIDUsuario()) {
            return abort(401);
        }
        $categoria->delete();
        return redirect()->route('indexCategoria')->with('msg_alert','Categoria deletado com sucesso!');
    }
}
