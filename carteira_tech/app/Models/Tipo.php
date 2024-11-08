<?php

namespace App\Models;

use App\Models\Scopes\UsuarioScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected bool $withAdmin;
    public function __construct() {
        $this->withAdmin = true;
        static::addGlobalScope(new UsuarioScope);
    }
    protected $fillable = [
        'name'
    ];

    public function contas()
    {
        return $this->belongsToMany('App\Models\Conta');
    }

    protected static function filtroIndex($dados)
    {
        $offset = request('offset') ?? 10;
        $tipos = Tipo::when(!empty($dados['descricao']), fn($q) => $q->where('nome', 'like', $dados['descricao']));
        return $tipos->paginate($offset);
    }

    public function getWithAdmin() {
        return $this->withAdmin;
    }

    public function setWithAdmin($withAdmin) {
        return $this->withAdmin = $withAdmin;
    }
}
