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

}
