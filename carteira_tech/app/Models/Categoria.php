<?php

namespace App\Models;

use App\Models\Scopes\UsuarioScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected bool $withAdmin;
    public function __construct()
    {
        $this->withAdmin = true;
        static::addGlobalScope(new UsuarioScope);
    }

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
        $offset = request('offset') ?? 10;
        $categorias = Categoria::when(!empty($dados['descricao']), fn($q) => $q->where('nome', 'like', "%" . $dados['descricao'] . "%"))
            ->when(!empty($dados['grupo_id']), function ($query) use ($dados) {
                $query->whereHas('grupos', fn($q) => $q->where('id', '=', $dados['grupo_id']));
            })->with('grupos');

        return $categorias->paginate($offset);
    }

    public function getWithAdmin()
    {
        return $this->withAdmin;
    }

    public function setWithAdmin($withAdmin)
    {
        return $this->withAdmin = $withAdmin;
    }

    public function getGrupoAttribute()
    {
        return $this->grupos->first();
    }
}
