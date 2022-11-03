<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimento_renda extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $valorAnterior;

    public function conta()
    {
        return $this->belongsTo('App\Models\Conta');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }

}
