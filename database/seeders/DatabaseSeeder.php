<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $roleSuperAdmin = \Spatie\Permission\Models\Role::create(['name' => 'super-admin']);
        $roleAdmin = \Spatie\Permission\Models\Role::create(['name' => 'administrador']);
        $roleManager = \Spatie\Permission\Models\Role::create(['name' => 'gerente']);
        $roleColaborator = \Spatie\Permission\Models\Role::create(['name' => 'colaborador']);

        \Spatie\Permission\Models\Permission::create(['name' => 'empresas.create'])->assignRole([$roleSuperAdmin]);
        \Spatie\Permission\Models\Permission::create(['name' => 'empresas.view'])->assignRole([$roleSuperAdmin, $roleAdmin]);
        \Spatie\Permission\Models\Permission::create(['name' => 'empresas.update'])->assignRole([$roleSuperAdmin, $roleAdmin]);
        \Spatie\Permission\Models\Permission::create(['name' => 'empresas.delete'])->assignRole([$roleSuperAdmin]);

        \Spatie\Permission\Models\Permission::create(['name' => 'departamentos.create'])->assignRole([$roleSuperAdmin, $roleAdmin]);
        \Spatie\Permission\Models\Permission::create(['name' => 'departamentos.view'])->assignRole([$roleSuperAdmin, $roleAdmin, $roleManager]);
        \Spatie\Permission\Models\Permission::create(['name' => 'departamentos.update'])->assignRole([$roleSuperAdmin, $roleAdmin, $roleManager]);
        \Spatie\Permission\Models\Permission::create(['name' => 'departamentos.delete'])->assignRole([$roleSuperAdmin, $roleAdmin]);

        \Spatie\Permission\Models\Permission::create(['name' => 'maquinarios.create'])->assignRole([$roleSuperAdmin, $roleAdmin]);
        \Spatie\Permission\Models\Permission::create(['name' => 'maquinarios.view'])->assignRole([$roleSuperAdmin, $roleAdmin, $roleManager]);
        \Spatie\Permission\Models\Permission::create(['name' => 'maquinarios.update'])->assignRole([$roleSuperAdmin, $roleAdmin, $roleManager]);
        \Spatie\Permission\Models\Permission::create(['name' => 'maquinarios.delete'])->assignRole([$roleSuperAdmin, $roleAdmin]);

        \App\Models\User::factory()->create([
            'name' => 'Carlos Barreto',
            'email' => 'carlosbarreto.eng@gmail.com',
            'password' => Hash::make('C@rlos0303')
        ])->assignRole('super-admin');

        \App\Models\User::factory()->create([
            'name' => 'Administrador da Empresa',
            'email' => 'admin@empresa.com',
            'password' => Hash::make('admin')
        ])->assignRole(['administrador', 'colaborador']);
    }
}
