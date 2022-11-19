<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimento_renda extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $valorAnterior;

    public function getValor() {
        return formatarNumero($this->valor);
    }

    public function contas()
    {
        return $this->belongsTo('App\Models\Conta');
    }

    public function categorias()
    {
        return $this->belongsTo('App\Models\Categoria');
    }

}
