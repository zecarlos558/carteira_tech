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
    public function index(Request $request)
    {
        $dados = $request->all();
        $dados = resolveOfsset($dados);
        $contas = Conta::filtroIndex($dados);
        $tipos = Tipo::all();

        return view('contas.conta', ['contas' => $contas,
                                     'tipos' => $tipos,
                                     'offset' => $dados['offset']])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = Tipo::all();

        return view('contas.createConta', ['tipos' => $tipos])->render();
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
        if ($conta->user_id_create != Aplication::consultaIDUsuario()) {
            return abort(401);
        }

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
        if ($conta->user_id_create != Aplication::consultaIDUsuario()) {
            return abort(401);
        }
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
    public function update(ContaRequest $request, $id)
    {
        $conta = Conta::findOrFail($id);
        if ($conta->user_id_create != Aplication::consultaIDUsuario()) {
            return abort(401);
        }
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
        if ($conta->user_id_create != Aplication::consultaIDUsuario()) {
            return abort(401);
        }
        if ($movimento->tipo == 'suprimento') {
            $conta->valor = $conta->valor + $movimento->valor;
        } elseif ($movimento->tipo == 'retirada') {
            $conta->valor = $conta->valor - $movimento->valor;
        }
        $conta->save();
    }

    public function updateMovimento($movimento)
    {
        if ((isset($movimento->contaAnterior) && $movimento->contaAnterior) && ($movimento->conta_id != $movimento->contaAnterior)) {
            $contaAnterior = Conta::findOrFail($movimento->contaAnterior);
            if ($contaAnterior->user_id_create != Aplication::consultaIDUsuario()) {
                return abort(401);
            }
            if ($movimento->tipo == 'suprimento') {
                $contaAnterior->valor = $contaAnterior->valor - $movimento->valorAnterior;
            } elseif ($movimento->tipo == 'retirada') {
                $contaAnterior->valor = $contaAnterior->valor + $movimento->valorAnterior;
            }
            $contaAnterior->save();
            $movimento->valorAnterior = 0;
        }
        $conta = Conta::findOrFail($movimento->conta->id);
        if ($conta->user_id_create != Aplication::consultaIDUsuario()) {
            return abort(401);
        }
        if ($movimento->tipo == 'suprimento') {
            $conta->valor = $conta->valor - $movimento->valorAnterior;
            $conta->valor = $conta->valor + $movimento->valor;
        } elseif ($movimento->tipo == 'retirada') {
            $conta->valor = $conta->valor + $movimento->valorAnterior;
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
        $conta = Conta::findOrFail($id);
        if ($conta->user_id_create != Aplication::consultaIDUsuario()) {
            return abort(401);
        }
        $conta->delete();
        return redirect()->route('indexConta')->with('msg_alert','Conta Deletada com sucesso!');
    }
}
