<?php

namespace App\Models;

use App\Models\Scopes\UsuarioScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movimento extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $valorAnterior;
    protected bool $withAdmin;
    public function __construct() {
        $this->withAdmin = false;
        static::addGlobalScope(new UsuarioScope);
    }

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
        $offset = request('offset') ?? 10;
        $movimentos = Movimento::select("*", DB::raw("(IF(movimentos.tipo = 'suprimento', +valor, -valor)) AS total"))
        ->when(!empty($dados['data']), function ($query) use($dados) {
            $query->whereMonth('data', '=', formatarData($dados['data'],'m'))
            ->whereYear('data', '=', formatarData($dados['data'],'Y'));
        })
        ->when(!empty($dados['descricao']), function ($query) use($dados) {
            $query->where(function ($q) use($dados) {
                $q->where('nome', 'like', "%".$dados['descricao']."%")
                ->orWhere('descricao', 'like', "%".$dados['descricao']."%");
            });
        })
        ->when(!empty($dados['conta_id']), fn($q) => $q->where('conta_id', '=', $dados['conta_id']))
        ->when(!empty($dados['categoria_id']), fn($q) => $q->where('categoria_id', '=', $dados['categoria_id']))
        ->when(!empty($dados['tipo']), fn($q) => $q->tipo($dados['tipo']))
        ->with('conta', 'categoria');
        return $movimentos->orderBy('data','desc')->paginate($offset);
    }

    public function scopeTipo($query, $tipo) {
        $query->where('tipo', $tipo);
    }

    public function scopeRetirada ($query) {
        $query->tipo('retirada');
    }

    public function scopeSuprimento ($query) {
        $query->tipo('suprimento');
    }
    
    public function getWithAdmin() {
        return $this->withAdmin;
    }

    public function setWithAdmin($withAdmin) {
        return $this->withAdmin = $withAdmin;
    }
}
