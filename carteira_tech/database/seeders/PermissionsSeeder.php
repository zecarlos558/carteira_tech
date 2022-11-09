<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create permissions categoria
        Permission::create(['name' => 'edit categoria']);
        Permission::create(['name' => 'delete categoria']);
        Permission::create(['name' => 'create categoria']);
        Permission::create(['name' => 'read categoria']);

        // create permissions conta
        Permission::create(['name' => 'edit conta']);
        Permission::create(['name' => 'delete conta']);
        Permission::create(['name' => 'create conta']);
        Permission::create(['name' => 'read conta']);

        // create permissions grupo
        Permission::create(['name' => 'edit grupo']);
        Permission::create(['name' => 'delete grupo']);
        Permission::create(['name' => 'create grupo']);
        Permission::create(['name' => 'read grupo']);

        // create permissions tipo
        Permission::create(['name' => 'edit tipo']);
        Permission::create(['name' => 'delete tipo']);
        Permission::create(['name' => 'create tipo']);
        Permission::create(['name' => 'read tipo']);

        // create permissions gasto
        Permission::create(['name' => 'edit gasto']);
        Permission::create(['name' => 'delete gasto']);
        Permission::create(['name' => 'create gasto']);
        Permission::create(['name' => 'read gasto']);

        // create permissions renda
        Permission::create(['name' => 'edit renda']);
        Permission::create(['name' => 'delete renda']);
        Permission::create(['name' => 'create renda']);
        Permission::create(['name' => 'read renda']);

        // create permissions movimento
        Permission::create(['name' => 'edit movimento']);
        Permission::create(['name' => 'delete movimento']);
        Permission::create(['name' => 'create movimento']);
        Permission::create(['name' => 'read movimento']);

        // create permissions usuario
        Permission::create(['name' => 'edit usuario']);
        Permission::create(['name' => 'delete usuario']);
        Permission::create(['name' => 'create usuario']);
        Permission::create(['name' => 'read usuario']);

        // create permissions relatorio
        Permission::create(['name' => 'edit relatorio']);
        Permission::create(['name' => 'delete relatorio']);
        Permission::create(['name' => 'create relatorio']);
        Permission::create(['name' => 'read relatorio']);

        // create permissions empresa
        Permission::create(['name' => 'edit empresa']);
        Permission::create(['name' => 'delete empresa']);
        Permission::create(['name' => 'create empresa']);
        Permission::create(['name' => 'read empresa']);

        // create permissions configurações sistema
        Permission::create(['name' => 'edit config']);
        Permission::create(['name' => 'delete config']);
        Permission::create(['name' => 'create config']);
        Permission::create(['name' => 'read config']);

        // create roles and assign existing permissions
        // create roles user
        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo('read categoria', 'read conta', 'read grupo',
                                'read tipo', 'read gasto', 'read renda',
                                'read movimento', 'read relatorio');
        $user->givePermissionTo('create categoria', 'create conta', 'create grupo',
                                'create tipo', 'create gasto','create renda',
                                'create movimento', 'create relatorio');
        $user->givePermissionTo('edit categoria', 'edit conta', 'edit usuario',
                                'edit grupo', 'edit tipo',
                                'edit gasto', 'edit renda',
                                'edit movimento', 'edit relatorio');
        $user->givePermissionTo('delete categoria', 'delete conta',
                                'delete grupo', 'delete tipo',
                                'delete gasto', 'delete renda',
                                'delete movimento', 'delete relatorio');
        // create roles manager
        $manager = Role::create(['name' => 'manager']);
        $manager->givePermissionTo('read categoria', 'read conta', 'read grupo',
                                    'read tipo', 'read gasto', 'read renda','read movimento');
        $manager->givePermissionTo('create categoria', 'create conta', 'create grupo',
                                    'create tipo', 'create gasto','create renda');
        $manager->givePermissionTo('edit categoria', 'edit conta',
                                    'edit grupo', 'edit tipo',
                                    'edit gasto', 'edit renda',
                                    'edit movimento');
        $manager->givePermissionTo('delete categoria', 'delete conta',
                                    'delete grupo', 'delete tipo',
                                    'delete gasto', 'delete renda',
                                    'delete movimento');
        // create roles admin
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('read categoria', 'read conta', 'read grupo',
                                    'read tipo', 'read gasto', 'read renda',
                                    'read movimento', 'read usuario', 'read relatorio');
        $admin->givePermissionTo('create categoria', 'create conta', 'create grupo',
                                    'create tipo', 'create gasto',
                                    'create usuario', 'create relatorio','create renda');
        $admin->givePermissionTo('edit categoria', 'edit conta',
                                    'edit grupo', 'edit tipo',
                                    'edit gasto', 'edit renda',
                                    'edit movimento','edit usuario', 'edit relatorio');
        $admin->givePermissionTo('delete categoria', 'delete conta',
                                    'delete grupo', 'delete tipo',
                                    'delete gasto', 'delete renda',
                                    'delete movimento','delete usuario', 'delete relatorio');
        // create roles super
        $super = Role::create(['name' => 'super']);
        $super->givePermissionTo('read categoria', 'read conta', 'read grupo',
                                    'read tipo', 'read gasto', 'read renda',
                                    'read movimento', 'read usuario', 'read relatorio',
                                    'read empresa', 'read config');
        $super->givePermissionTo('create categoria', 'create conta', 'create grupo',
                                    'create tipo', 'create gasto',
                                    'create usuario', 'create relatorio',
                                    'create empresa', 'create config','create renda');
        $super->givePermissionTo('edit categoria', 'edit conta',
                                    'edit grupo', 'edit tipo',
                                    'edit gasto', 'edit renda',
                                    'edit movimento','edit usuario', 'edit relatorio',
                                    'edit empresa', 'edit config');
        $super->givePermissionTo('delete categoria', 'delete conta',
                                    'delete grupo', 'delete tipo',
                                    'delete gasto', 'delete renda',
                                    'delete movimento','delete usuario', 'delete relatorio',
                                    'delete empresa', 'delete config');
        // create roles Super Admin
        Role::create(['name' => 'Super Admin']);

    }
}
