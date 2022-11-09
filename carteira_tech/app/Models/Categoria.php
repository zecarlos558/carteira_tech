<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'name'
    ];

    public function grupos()
    {
        return $this->belongsToMany('App\Models\Grupo');
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
        $categorias = Categoria::whereIn('user_id_create',[1,Aplication::consultaIDUsuario()])->with('grupos');
        if ( (isset($dados['categoria']) && $dados['categoria']!=null) && (isset($dados['grupo']) && $dados['grupo']!=null) ) {
            $categorias = $categorias->where('id',formataPesquisa($dados['categoria']))
            ->leftJoin('categoria_grupo','categoria_grupo.categoria_id','categorias.id')
            ->where('categoria_grupo.grupo_id',$dados['grupo']);
        } elseif ( (isset($dados['categoria']) && $dados['categoria']!=null) ) {
            $categorias = $categorias->where('id',formataPesquisa($dados['categoria']));
        } elseif ( (isset($dados['grupo']) && $dados['grupo']!=null) ) {
            $categorias = $categorias
            ->leftJoin('categoria_grupo','categoria_grupo.categoria_id','categorias.id')
            ->where('categoria_grupo.grupo_id',$dados['grupo']);
        }

        return $categorias->get();
    }

}
