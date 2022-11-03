<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'name','valor'
    ];

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

}
