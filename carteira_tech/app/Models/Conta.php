<?php

namespace App\Models;

use App\Models\Scopes\UsuarioScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected bool $withAdmin;
    public function __construct() {
        $this->withAdmin = false;
        static::addGlobalScope(new UsuarioScope);
    }
    protected $fillable = [
        'nome','valor','user_id_create','user_id_update'
    ];

    public function getValor()
    {
        return formatarNumero($this->valor);
    }

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
        $offset = request('offset') ?? 10;
        $contas = Conta::when(!empty($dados['descricao']), fn($q) => $q->where('nome', 'like', "%" . $dados['descricao'] . "%"))
            ->when(!empty($dados['tipo_id']), function ($query) use ($dados) {
                $query->whereHas('tipos', fn($q) => $q->where('id', $dados['tipo_id']));
            })->with('tipos');

        return $contas->paginate($offset);
    }

    public function getWithAdmin() {
        return $this->withAdmin;
    }

    public function setWithAdmin($withAdmin) {
        return $this->withAdmin = $withAdmin;
    }

    public function getTipoAttribute() {
        return $this->tipos->first();
    }
}
