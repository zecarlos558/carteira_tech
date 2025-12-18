<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Logger;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Aplication;
use App\Models\Categoria;
use App\Models\Conta;
use App\Models\Grupo;
use App\Models\Movimento;
use App\Models\Relatorio;
use App\Models\Tipo;
use Spatie\Permission\Models\Role;

class AplicationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->data != null) {
            $data = $request->data;
        } else {
            $data = date('Y-m-d');
        }
        $usuario = Aplication::consultaUsuario();
        $dadosRenda = Relatorio::consultaTotalRenda()
        ->lancamentoEntreContas()
        ->whereMonth('data', '=', formatarData($data,'m'))
        ->whereYear('data', '=', formatarData($data,'Y'))
        ->first();
        $dadosGastos = Relatorio::consultaTotalGastos()
        ->lancamentoEntreContas()
        ->whereMonth('data', '=', formatarData($data,'m'))
        ->whereYear('data', '=', formatarData($data,'Y'))
        ->first();

        $relatorio = new Relatorio;
        $relatorio->setValorSaida($dadosGastos->valorTotal);
        $relatorio->setValorEntrada($dadosRenda->valorTotal);
        $relatorio->setValorSaldo();
        $relatorio->calculaBarraProgresso();

        $contas = Conta::orderBy('valor','desc')->get();
        $movimentos = Movimento::orderBy('data','desc')->with('categoria')->limit(5)->get();

        if (session()->missing('device')) {
            session(['device' => checkDevice()]);
        }

        return view('inicial',['usuario' => $usuario,
                               'relatorio' => $relatorio,
                               'contas' => $contas,
                               'movimentos' => $movimentos]);
    }

    public function dashboard()
    {
        $usuario = Aplication::consultaUsuario();

        return view('dashboard',['user' => $usuario]);
    }

    public function painelControle(Request $request)
    {
        $dados = $request->all();
        $roles = Role::all();
        $dados = resolveOfsset($dados);
        $users = Aplication::filtroIndex($dados);

        return view('aplication.painelControle' ,['usuarios' => $users, 'funcoes' => $roles, 'offset' => $dados['offset']]);
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
        $log->log('info','Usuario criou um novo usuário! / ID:'.$usuario->id.' - Nome:'.$usuario->name);
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
        if ($usuario->email != $request->email) {
            $usuario->email = $request->email;
            $usuario->email_verified_at = null;
        }
        $usuario->syncRoles([$request->funcao]);
        $usuario->save();
        $log = new Logger();
        $log->log('info','Usuario alterou um usuário! / ID:'.$usuario->id.' - Nome:'.$usuario->name);
        return redirect()->route('dashboard')->with('msg_alert','Usuário editado com sucesso!');
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
        Movimento::where('user_id_create',$id)->delete();
        Tipo::where('user_id_create',$id)->delete();
        Conta::where('user_id_create',$id)->delete();
        Grupo::where('user_id_create',$id)->delete();
        Categoria::where('user_id_create',$id)->delete();
        $usuario->delete();
        $log = new Logger();
        $log->log('info','Usuario Deletou um usuário! / ID:'.$usuario->id.' - Nome:'.$usuario->name);
        return redirect()->route('painelControleUsuario')->with('msg_alert','Usuário deletado com sucesso!');
    }

    public function cadastro($id)
    {
        Conta::create([
            'nome' => "Carteira",
            'valor' => 0,
            'user_id_create' => $id,
            'user_id_update' => $id
        ])->tipos()->attach(1);

        return redirect()->route('inicial')->with('msg_alert', 'Usuário Cadastrado com Sucesso!');
    }

    public function autentica_email()
    {
        return redirect()->route('dashboard')->with('msg_alert', 'Usuário com email autenticado!');
    }

}
