<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Aplication extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function consultaIDUsuario()
    {
        return auth()->user()->id;
    }

    protected static function consultaUsuario()
    {
        return User::findOrFail(auth()->user()->id);
    }

    protected static function consultaPermissao()
    {
        $user = auth()->user();
        return $user->getPermissionNames();
    }

    protected static function verificaPermissao($permissao)
    {
        $user = auth()->user();
        return $user->can($permissao);
    }

    protected static function consultaFuncao()
    {
        $user = auth()->user();
        return $user->getRoleNames()[0];
    }

    protected static function verificaFuncao($funcao)
    {
        $user = auth()->user();
        return $user->hasRole($funcao);
    }


}
