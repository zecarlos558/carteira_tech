<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movimento extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $valorAnterior;

    public function getValor() {
        return formatarNumero($this->valor);
    }

    public function conta()
    {
        return $this->belongsTo('App\Models\Conta');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }

    protected static function filtroIndex($dados)
    {
        $movimentos = Movimento::where('movimentos.user_id_create',Aplication::consultaIDUsuario())
        ->join('categorias','categorias.id','movimentos.categoria_id')
        ->whereMonth('data', '=', formatarData($dados['data'],'m'))
        ->whereYear('data', '=', formatarData($dados['data'],'Y'))
        ->addSelect(DB::raw("(IF(movimentos.tipo = 'suprimento', +valor, -valor)) AS total,
        movimentos.id, movimentos.nome, valor, tipo, data, categorias.nome as categoria_nome"));
        if ( (isset($dados['categoria']) && $dados['categoria']!=null) && (isset($dados['tipo']) && $dados['tipo']!=null) ) {
            $movimentos = $movimentos->where('categoria_id',$dados['categoria'])
            ->where('tipo',$dados['tipo']);
        } elseif ( (isset($dados['categoria']) && $dados['categoria']!=null) ) {
            $movimentos = $movimentos->where('categoria_id',$dados['categoria']);
        } elseif ( (isset($dados['tipo']) && $dados['tipo']!=null) ) {
            $movimentos = $movimentos->where('tipo',$dados['tipo']);
        }
        return $movimentos->orderBy('data','desc')->get();
    }

}
