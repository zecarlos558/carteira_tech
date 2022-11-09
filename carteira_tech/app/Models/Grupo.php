<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function categorias()
    {
        return $this->belongsToMany('App\Models\Categoria');
    }

    protected static function filtroIndex($dados)
    {
        $grupos = Grupo::whereIn('user_id_create',[1,Aplication::consultaIDUsuario()]);
        if ( (isset($dados['grupo']) && $dados['grupo']!=null) ) {
            $grupos = $grupos->where('id',formataPesquisa($dados['grupo']));
        }
        return $grupos->get();
    }

}
