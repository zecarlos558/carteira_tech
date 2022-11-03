<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Logger;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Aplication;
use Spatie\Permission\Models\Role;

class AplicationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Aplication::consultaUsuario();
        //session(['device' => checkDevice()]);

        return view('inicial',['usuario' => $usuario]);
    }

    public function dashboard()
    {
        $usuario = Aplication::consultaUsuario();
        $usuario->funcao = $usuario->getRoleNames()[0];

        return view('dashboard',['user' => $usuario]);
    }

    public function painelControle()
    {
        $roles = Role::all()->pluck('name');
        $funcao = retornaRole(Aplication::consultaFuncao(),$roles);
        $users = User::role($funcao)->get();

        return view('aplication.painelControle' ,['usuarios' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->pluck('name');
        $funcao = retornaRole(Aplication::consultaFuncao(),$roles);
        $funcoes = Role::whereIn('name', $funcao)->get();

        return view('aplication.createUsuario' ,['funcoes' => $funcoes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        if ($request->password != $request->password_confirmation) {
            return redirect()->route('createUsuario')->with('msg_alert','A confirmação da senha não corresponde');
        }

        $usuario = new User;
        $usuario->name = $request->nome;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        try {
            $usuario->save();
        } catch (\Throwable $th) {
            return redirect()->route('createUsuario')->with('msg_alert','Campos inseridos Inválidos');
        }
        $usuario->assignRole($request->funcao);
        $log = new Logger();
        $log->log('info','Usuario criou um novo usuário!');
        return redirect()->route('painelControleUsuario')->with('msg_alert','Usuário Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->funcao = $usuario->getRoleNames()[0];

        return view('aplication.showUsuario' ,['usuario' => $usuario]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Role::all()->pluck('name');
        $funcao = retornaRole(Aplication::consultaFuncao(),$roles);
        $funcoes = Role::whereIn('name', $funcao)->get();

        return view('aplication.editUsuario' ,['usuario' => $usuario,
                                               'funcoes' => $funcoes]);
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
        $usuario = User::findOrFail($id);
        $usuario->name = $request->nome;
        $usuario->email = $request->email;
        $usuario->syncRoles([$request->funcao]);
        $usuario->save();
        $log = new Logger();
        $log->log('info','Usuario alterou um usuário!');
        return redirect()->route('painelControleUsuario')->with('msg_alert','Usuário editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->removeRole($usuario->getRoleNames()[0]);
        $usuario->delete();
        $log = new Logger();
        $log->log('info','Usuario Deletou um usuário!');
        return redirect()->route('painelControleUsuario')->with('msg_alert','Usuário deletado com sucesso!');
    }
}
