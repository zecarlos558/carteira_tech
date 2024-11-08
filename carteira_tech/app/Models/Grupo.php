<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\UsuarioScope;

class Grupo extends Model
{
    use HasFactory;

    protected bool $withAdmin;
    public function __construct() {
        $this->withAdmin = true;
        static::addGlobalScope(new UsuarioScope);
    }

    protected $fillable = [
        'name'
    ];

    public function categorias()
    {
        return $this->belongsToMany('App\Models\Categoria');
    }

    protected static function filtroIndex($dados)
    {
        $offset = request('offset') ?? 10;
        $grupos = Grupo::when(!empty($dados['descricao']), fn($q) => $q->where('nome', 'like', $dados['descricao']));
        return $grupos->paginate($offset);
    }

    public function getWithAdmin() {
        return $this->withAdmin;
    }

    public function setWithAdmin($withAdmin) {
        return $this->withAdmin = $withAdmin;
    }
}
