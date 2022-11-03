<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Renda
        Categoria::create(['nome' => 'Remuneração',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(1);
        Categoria::create(['nome' => 'Bônus',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(1);
        Categoria::create(['nome' => 'Rendimento',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(1);
        Categoria::create(['nome' => 'Outras Rendas',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(1);
        Categoria::create(['nome' => 'Empréstimo',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(1);
        // Gasto Essenciais
        Categoria::create(['nome' => 'Moradia',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(2);
        Categoria::create(['nome' => 'Contas Residenciais',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(2);
        Categoria::create(['nome' => 'Saúde',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(2);
        Categoria::create(['nome' => 'Educação',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(2);
        Categoria::create(['nome' => 'Transporte',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(2);
        Categoria::create(['nome' => 'Mercado',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(2);
        // Estilo de vida
        Categoria::create(['nome' => 'Empregada Doméstica',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(3);
        Categoria::create(['nome' => 'TV/Internet/Telefone',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(3);
        Categoria::create(['nome' => 'Taxas Bancárias',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(3);
        Categoria::create(['nome' => 'Saques',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(3);
        Categoria::create(['nome' => 'Bares/Restaurantes',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(3);
        Categoria::create(['nome' => 'Lazer',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(3);
        Categoria::create(['nome' => 'Compras',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(3);
        Categoria::create(['nome' => 'Cuidados Pessoais',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(3);
        Categoria::create(['nome' => 'Serviços',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(3);
        Categoria::create(['nome' => 'Viagem',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(3);
        Categoria::create(['nome' => 'Presente/Doações',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(3);
        Categoria::create(['nome' => 'Familia/Filhos',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(3);
        Categoria::create(['nome' => 'Despesas do Trabalho',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(3);
        Categoria::create(['nome' => 'Outros Gastos',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(3);
        Categoria::create(['nome' => 'Impostos',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(3);
        Categoria::create(['nome' => 'Juros de Cartão',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(4);
        Categoria::create(['nome' => 'Crediário',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(4);
        Categoria::create(['nome' => 'Cheque Especial',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(4);
        Categoria::create(['nome' => 'Credito Consignado',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(4);
        Categoria::create(['nome' => 'Carnê',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(4);
        Categoria::create(['nome' => 'Outros Empréstimos',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(4);
        Categoria::create(['nome' => 'Juros',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(4);
        Categoria::create(['nome' => 'Pagamento de Cartão',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(5);
        Categoria::create(['nome' => 'Resgate',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(5);
        Categoria::create(['nome' => 'Aplicação',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(5);
        Categoria::create(['nome' => 'Transferência',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(5);
        Categoria::create(['nome' => 'Categorizar',
        'user_id_create' => 1,
        'user_id_update' => 1
        ])->grupos()->attach(6);
    }
}
