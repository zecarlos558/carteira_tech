<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcoes = Role::all();
        $listaFuncoes = Role::all()->pluck('name');

        return view('config.roles.roles', [
            'funcoes' => $funcoes,
            'listaFuncoes' => $listaFuncoes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $funcoes = [
            'categoria', 'conta', 'grupo', 'tipo', 'gasto','caixa',
            'renda', 'relatorio', 'empresa', 'configuração', 'usuario'
        ];

        return view('config.roles.createRole', ['funcoes' => $funcoes])->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $roles = $request->all();
        $funcoes = [];
        unset($roles['_token']);
        unset($roles['nome']);
        foreach ($roles as $key => $funcao) {
            if (strpos($funcao, 'configuração') !== false) {
                $funcao = str_replace("configuração", "config", $funcao);
            }
            array_push($funcoes, $funcao);
        }
        $role = Role::create(['name' => $request->nome]);
        $role->givePermissionTo($funcoes);

        return redirect()->route('indexRole')->with('msg_alert','Função Cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findById($id);
        $usuarios = User::role($role->name)->get();
        $funcoes = [
            'categoria', 'conta', 'grupo', 'tipo', 'gasto','caixa',
            'renda', 'relatorio', 'empresa', 'configuração', 'usuario'
        ];

        return view('config.roles.showRole', ['role' => $role,
                                              'funcoes' => $funcoes,
                                              'usuarios' => $usuarios])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findById($id);
        $funcoes = [
            'categoria', 'conta', 'grupo', 'tipo', 'gasto','caixa',
            'renda', 'relatorio', 'empresa', 'configuração', 'usuario'
        ];

        return view('config.roles.editRole', ['role' => $role,
                                              'funcoes' => $funcoes])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $roles = $request->all();
        $funcoes = [];
        unset($roles['_token']);
        unset($roles['nome']);
        foreach ($roles as $key => $funcao) {
            if (strpos($funcao, 'configuração') !== false) {
                $funcao = str_replace("configuração", "config", $funcao);
            }
            array_push($funcoes, $funcao);
        }

        $role = Role::findById($id);
        $role->name = $request->nome;
        $role->syncPermissions($funcoes);
        $role->save();

        return redirect()->route('indexRole')->with('msg_alert','Função editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findById($id);
        $role->revokePermissionTo($role->permissions->pluck('name'));
        $role->delete();

        return redirect()->route('indexRole')->with('msg_alert','Função deletada com sucesso!');
    }
}
