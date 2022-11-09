<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'name'
    ];

    public function contas()
    {
        return $this->belongsToMany('App\Models\Conta');
    }

    protected static function filtroIndex($dados)
    {
        $tipos = Tipo::whereIn('user_id_create',[1,Aplication::consultaIDUsuario()]);
        if ( (isset($dados['tipo']) && $dados['tipo']!=null) ) {
            $tipos = $tipos->where('id',formataPesquisa($dados['tipo']));
        }
        return $tipos->get();
    }

}
