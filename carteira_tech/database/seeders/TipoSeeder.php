<?php

namespace Database\Seeders;

use App\Models\Tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::create(['nome' => 'Carteira',
        'user_id_create' => 1,
        'user_id_update' => 1
        ]);
        Tipo::create(['nome' => 'Conta Corrente',
        'user_id_create' => 1,
        'user_id_update' => 1
        ]);
        Tipo::create(['nome' => 'Cartão de Crédito',
        'user_id_create' => 1,
        'user_id_update' => 1
        ]);
        Tipo::create(['nome' => 'Poupança',
        'user_id_create' => 1,
        'user_id_update' => 1
        ]);
        Tipo::create(['nome' => 'Dinheiro',
        'user_id_create' => 1,
        'user_id_update' => 1
        ]);
        Tipo::create(['nome' => 'Empréstimo',
        'user_id_create' => 1,
        'user_id_update' => 1
        ]);
        Tipo::create(['nome' => 'Fundo de Investimento',
        'user_id_create' => 1,
        'user_id_update' => 1
        ]);
        Tipo::create(['nome' => 'CDB',
        'user_id_create' => 1,
        'user_id_update' => 1
        ]);
        Tipo::create(['nome' => 'Previdência Privada',
        'user_id_create' => 1,
        'user_id_update' => 1
        ]);
    }
}
