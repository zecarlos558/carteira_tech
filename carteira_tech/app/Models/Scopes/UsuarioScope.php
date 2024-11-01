<?php

namespace App\Models\Scopes;

use App\Models\Aplication;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class UsuarioScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->when($model->getWithAdmin() == true, function ($query) {
            $query->whereIn('user_id_create',[1, Aplication::consultaIDUsuario()]);
        }, function ($query) {
            $query->whereIn('user_id_create',[Aplication::consultaIDUsuario()]);
        });
    }
}
