<?php

namespace Database\Seeders;

use App\Models\Conta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Conta::create(['nome' => 'Carteira',
        'valor' => 0,
        'user_id_create' => 1,
        'user_id_update' => 1])->tipos()->attach(1);
    }
}
