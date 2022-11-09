<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'nome','valor','user_id_create','user_id_update'
    ];

    public function tipos()
    {
        return $this->belongsToMany('App\Models\Tipo');
    }

    public function movimentos()
    {
        return $this->hasMany('App\Models\Movimento');
    }

    public function movimento_rendas()
    {
        return $this->hasMany('App\Models\Movimento_renda');
    }

    public function movimento_gastos()
    {
        return $this->hasMany('App\Models\Movimento_gasto');
    }

    protected static function filtroIndex($dados)
    {
        $contas = Conta::where('user_id_create',[Aplication::consultaIDUsuario()])->with('tipos');
        if ( (isset($dados['conta']) && $dados['conta']!=null) && (isset($dados['tipo']) && $dados['tipo']!=null) ) {
            $contas = $contas->where('id',formataPesquisa($dados['conta']))
            ->leftJoin('conta_tipo','conta_tipo.conta_id','contas.id')
            ->where('conta_tipo.tipo_id',$dados['tipo']);
        } elseif ( (isset($dados['conta']) && $dados['conta']!=null) ) {
            $contas = $contas->where('id',formataPesquisa($dados['conta']));
        } elseif ( (isset($dados['tipo']) && $dados['tipo']!=null) ) {
            $contas = $contas
            ->leftJoin('conta_tipo','conta_tipo.conta_id','contas.id')
            ->where('conta_tipo.tipo_id',$dados['tipo']);
        }

        return $contas->get();
    }

}
