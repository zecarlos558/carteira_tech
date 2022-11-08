<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovimentoRequest;
use App\Models\Aplication;
use App\Models\Categoria;
use App\Models\Conta;
use App\Models\Movimento;
use App\Models\Movimento_gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MovimentoGastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movimentos = Movimento::where('tipo','retirada')->with('categoria')
        ->where('user_id_update',Aplication::consultaIDUsuario())->get();
        $listaNomes = Movimento::where('tipo','retirada')
        ->where('user_id_update',Aplication::consultaIDUsuario())
        ->select('id','nome','valor')->get();

        return view('movimento_gasto.movimento', ['movimentos' => $movimentos,
                                                  'listaNomes' => $listaNomes])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contas = Conta::where('user_id_create',Aplication::consultaIDUsuario())->get();
        $categorias = Categoria::whereIn('user_id_create',[1,Aplication::consultaIDUsuario()])->get();

        return view('movimento_gasto.createMovimento', ['contas' => $contas,
                                                        'categorias' => $categorias])->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovimentoRequest $request)
    {
        $movimento = new Movimento();
        $movimento->nome = $request->nome;
        $movimento->valor = $request->valor;
        $movimento->data = $request->data;
        $movimento->descricao = $request->descricao;
        $movimento->conta_id = $request->conta;
        $movimento->categoria_id = $request->categoria;
        $movimento->tipo = 'retirada';
        $movimento->user_id_create = Aplication::consultaIDUsuario();
        $movimento->user_id_update = Aplication::consultaIDUsuario();

        try {
            $movimento->save();
        } catch (\Exception $e) {
            Log::channel('main')->error($e->getMessage());
            return redirect()->route('createMovimentoGasto')->with('msg_alert','Campos Inseridos invalidos!');
        }

        $conta = new ContasController();
        $conta->storeMovimento($movimento);

        return redirect()->route('indexMovimentoGasto')->with('msg_alert','Movimento Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movimento = Movimento::findOrFail($id);

        return view('movimento_gasto.showMovimento', ['movimento' => $movimento])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movimento = Movimento::findOrFail($id);
        $contas = Conta::where('user_id_create',Aplication::consultaIDUsuario())->get();
        $categorias = Categoria::whereIn('user_id_create',[1,Aplication::consultaIDUsuario()])->get();

        return view('movimento_gasto.editMovimento', ['movimento' => $movimento,
                                                        'contas' => $contas,
                                                        'categorias' => $categorias])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MovimentoRequest $request, $id)
    {
        $movimento = Movimento::findOrFail($id);
        $movimento->nome = $request->nome;
        $movimento->valorAnterior = $movimento->valor;
        $movimento->valor = $request->valor;
        $movimento->data = $request->data;
        $movimento->descricao = $request->descricao;
        $movimento->conta_id = $request->conta;
        $movimento->categoria_id = $request->categoria;
        $movimento->user_id_update = Aplication::consultaIDUsuario();

        try {
            $movimento->save();
        } catch (\Exception $e) {
            Log::channel('main')->error($e->getMessage());
            return redirect()->route('editMovimentoGasto')->with('msg_alert','Campos Inseridos invalidos!');
        }

        $conta = new ContasController();
        $conta->updateMovimento($movimento);

        return redirect()->route('indexMovimentoGasto')->with('msg_alert','Movimento alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movimento = Movimento::findOrFail($id);
        $conta = Conta::findOrFail($movimento->conta->id);
        $conta->valor = $conta->valor + $movimento->valor;
        $conta->save();
        $movimento->delete();

        return redirect()->route('indexMovimentoGasto')->with('msg_alert','Movimento deletado com sucesso!');
    }
}
