<?php

namespace Database\Seeders;

use App\Models\Departamento;
use App\Models\Empresa;
use App\Models\Maquinario;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roleSuperAdmin = Role::create(['name' => 'super-admin', 'description' => 'Super Administrador']);
        $roleAdmin = Role::create(['name' => 'administrador', 'description' => 'Administrador']);

        Permission::create(['name' => 'apps.tempos', 'description' => 'Tempos'])->syncRoles($roleSuperAdmin);
        Permission::create(['name' => 'apps.custos', 'description' => 'Custos'])->syncRoles($roleSuperAdmin);
        Permission::create(['name' => 'apps.vendas', 'description' => 'Vendas'])->syncRoles($roleSuperAdmin);
        Permission::create(['name' => 'apps.cargas', 'description' => 'Cargas'])->syncRoles($roleSuperAdmin);
        Permission::create(['name' => 'apps.treinamentos', 'description' => 'Treinamentos'])->syncRoles($roleSuperAdmin);

        Permission::create(['name' => 'empresas.create', 'description' => 'Criar'])->syncRoles($roleSuperAdmin);
        Permission::create(['name' => 'empresas.view', 'description' => 'Visualizar'])->syncRoles($roleSuperAdmin);
        Permission::create(['name' => 'empresas.update', 'description' => 'Atualizar'])->syncRoles($roleSuperAdmin);
        Permission::create(['name' => 'empresas.delete', 'description' => 'Apagar'])->syncRoles($roleSuperAdmin);

        Permission::create(['name' => 'departamentos.create', 'description' => 'Criar'])->syncRoles([$roleSuperAdmin, $roleAdmin]);
        Permission::create(['name' => 'departamentos.view', 'description' => 'Visualizar'])->syncRoles([$roleSuperAdmin, $roleAdmin]);
        Permission::create(['name' => 'departamentos.update', 'description' => 'Atualizar'])->syncRoles([$roleSuperAdmin, $roleAdmin]);
        Permission::create(['name' => 'departamentos.delete', 'description' => 'Apagar'])->syncRoles([$roleSuperAdmin, $roleAdmin]);

        Permission::create(['name' => 'maquinario.create', 'description' => 'Criar'])->syncRoles([$roleSuperAdmin, $roleAdmin]);
        Permission::create(['name' => 'maquinario.view', 'description' => 'Visualizar'])->syncRoles([$roleSuperAdmin, $roleAdmin]);
        Permission::create(['name' => 'maquinario.update', 'description' => 'Atualizar'])->syncRoles([$roleSuperAdmin, $roleAdmin]);
        Permission::create(['name' => 'maquinario.delete', 'description' => 'Apagar'])->syncRoles([$roleSuperAdmin, $roleAdmin]);

        Empresa::create([
            "cnpj" => "45631323000111",
            "razao_social" => "CARLOS ROBERTO BARRETO JUNIOR 08460433609",
            "nome_fantasia" => "LKHS INFORMATICA",
            "cep" => "36506116",
            "logradouro" => "RUA GOIÁS",
            "numero" => 119,
            "bairro" => "CHIQUITO GAZOLLA",
            "cidade" => "UBÁ",
            "uf" => "MG"
        ]);

        Departamento::create([
            'empresas_id' => 1,
            'nome' => "Departamento 1"
        ]);

        Departamento::create([
            'empresas_id' => 1,
            'nome' => "Departamento 2"
        ]);

        Maquinario::create([
            'empresas_id' => 1,
            'departamentos_id' => 1,
            'nome' => "Maquinário 1"
        ]);

        Maquinario::create([
            'empresas_id' => 1,
            'departamentos_id' => 2,
            'nome' => "Maquinário 2"
        ]);

        Maquinario::create([
            'empresas_id' => 1,
            'departamentos_id' => 1,
            'nome' => "Maquinário 3"
        ]);

        Maquinario::create([
            'empresas_id' => 1,
            'departamentos_id' => 2,
            'nome' => "Maquinário 4"
        ]);

        User::factory()->create([
            'name' => 'Carlos Barreto',
            'email' => 'carlosbarreto.eng@gmail.com',
            'password' => Hash::make('C@rlos0303')
        ])->assignRole('super-admin');

        User::factory()->create([
            'empresas_id' => 1,
            'name' => 'Administrador da Empresa',
            'email' => 'admin@empresa.com',
            'password' => Hash::make('C@rlos0303')
        ])->assignRole(['administrador']);
    }
}
