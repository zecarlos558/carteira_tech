<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContaRequest;
use App\Models\Aplication;
use App\Models\Categoria;
use App\Models\Conta;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contas = Conta::where('user_id_create',Aplication::consultaIDUsuario())->get();
        $listaNomes = Conta::select('nome')->get();

        return view('contas.conta', ['contas' => $contas,
                                     'listaNomes' => $listaNomes])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = Tipo::all();
        $categorias = Categoria::all();

        return view('contas.createConta', ['tipos' => $tipos,
                                                  'categorias' => $categorias])->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContaRequest $request)
    {
        $conta = new Conta();
        $conta->nome = $request->nome;
        $conta->valor = $request->valor;
        $conta->user_id_create = Aplication::consultaIDUsuario();
        $conta->user_id_update = Aplication::consultaIDUsuario();
        try {
            $conta->save();
        } catch (\Exception $e) {
            Log::channel('main')->error($e->getMessage());
            return redirect()->route('createConta')->with('msg_alert','Campos Inseridos invalidos!');
        }
        $conta->tipos()->attach($request->tipo);
        return redirect()->route('indexConta')->with('msg_alert','Conta Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conta = Conta::findOrFail($id);

        return view('contas.showConta', ['conta' => $conta])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conta = Conta::findOrFail($id);
        $tipos = Tipo::all();

        return view('contas.editConta', ['conta' => $conta,
                                         'tipos' => $tipos])->render();
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
        $conta = Conta::findOrFail($id);
        $conta->nome = $request->nome;
        $conta->valor = $request->valor;
        $conta->user_id_update = Aplication::consultaIDUsuario();
        try {
            $conta->save();
        } catch (\Exception $e) {
            Log::channel('main')->error($e->getMessage());
            return redirect()->route('createConta')->with('msg_alert','Campos Inseridos invalidos!');
        }
        $conta->tipos()->detach($conta->tipos[0]->id);
        $conta->tipos()->attach($request->tipo);
        return redirect()->route('indexConta')->with('msg_alert','Conta Alterada com sucesso!');
    }

    public function storeMovimento($movimento)
    {
        $conta = Conta::findOrFail($movimento->conta->id);
        if ($movimento->tipo == 'suprimento') {
            $conta->valor = $conta->valor + $movimento->valor;
        } elseif ($movimento->tipo == 'retirada') {
            $conta->valor = $conta->valor - $movimento->valor;
        }
        $conta->save();
    }

    public function updateMovimento($movimento)
    {
        $conta = Conta::findOrFail($movimento->conta->id);

        if ($movimento->tipo == 'suprimento') {
            $conta->valor = $conta->valor - $movimento->valorAnterio;
            $conta->valor = $conta->valor + $movimento->valor;
        } elseif ($movimento->tipo == 'retirada') {
            $conta->valor = $conta->valor + $movimento->valorAnterio;
            $conta->valor = $conta->valor - $movimento->valor;
        }
        $conta->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conta = Conta::findOrFail($id)->delete();
        return redirect()->route('indexConta')->with('msg_alert','Conta Deletada com sucesso!');
    }
}
