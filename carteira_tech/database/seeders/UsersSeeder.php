<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Classes\Logger;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Administrador",
            'email' => "administrador@gmail.com",
            'password' => Hash::make("admin123"),
        ])->assignRole('Super Admin');
        $log = new Logger();
        $log->log('info','Foi cadastrado um novo usuário através de seeders!');
    }
}
