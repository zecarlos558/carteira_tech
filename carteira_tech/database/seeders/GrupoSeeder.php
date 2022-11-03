<?php

namespace Database\Seeders;

use App\Models\Grupo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grupo::create(['nome' => 'Renda',
        'user_id_create' => 1,
        'user_id_update' => 1
        ]);
        Grupo::create(['nome' => 'Gastos Essenciais',
        'user_id_create' => 1,
        'user_id_update' => 1
        ]);
        Grupo::create(['nome' => 'Estilo de Vida',
        'user_id_create' => 1,
        'user_id_update' => 1
        ]);
        Grupo::create(['nome' => 'Empréstimo',
        'user_id_create' => 1,
        'user_id_update' => 1
        ]);
        Grupo::create(['nome' => 'Lançamento entre Contas',
        'user_id_create' => 1,
        'user_id_update' => 1
        ]);
        Grupo::create(['nome' => 'Não Classificado',
        'user_id_create' => 1,
        'user_id_update' => 1
        ]);
    }
}
