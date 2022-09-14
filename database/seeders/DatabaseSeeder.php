<?php

namespace Database\Seeders;

use App\Models\Departamento;
use App\Models\Empresa;
use App\Models\Maquinario;
use App\Models\Peca;
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

        Permission::create(['name' => 'peca.create', 'description' => 'Criar'])->syncRoles([$roleSuperAdmin, $roleAdmin]);
        Permission::create(['name' => 'peca.view', 'description' => 'Visualizar'])->syncRoles([$roleSuperAdmin, $roleAdmin]);
        Permission::create(['name' => 'peca.update', 'description' => 'Atualizar'])->syncRoles([$roleSuperAdmin, $roleAdmin]);
        Permission::create(['name' => 'peca.delete', 'description' => 'Apagar'])->syncRoles([$roleSuperAdmin, $roleAdmin]);

        Empresa::create([
            "cnpj" => "10000000000001",
            "razao_social" => "EMPRESA 1 LTDA",
            "nome_fantasia" => "EMPRESA 1",
            "cep" => "12345678",
            "logradouro" => "RUA DE TESTE",
            "numero" => 1,
            "bairro" => "CENTRO",
            "cidade" => "SÃO PAULO",
            "uf" => "SP"
        ]);

        Empresa::create([
            "cnpj" => "20000000000002",
            "razao_social" => "EMPRESA 2 LTDA",
            "nome_fantasia" => "EMPRESA 2",
            "cep" => "12345678",
            "logradouro" => "RUA DE TESTE",
            "numero" => 2,
            "bairro" => "CENTRO",
            "cidade" => "SÃO PAULO",
            "uf" => "SP"
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

        Departamento::create([
            'empresas_id' => 1,
            'nome' => "Departamento 1.1"
        ]);

        Departamento::create([
            'empresas_id' => 1,
            'nome' => "Departamento 1.2"
        ]);

        Departamento::create([
            'empresas_id' => 2,
            'nome' => "Departamento 2.1"
        ]);

        Departamento::create([
            'empresas_id' => 2,
            'nome' => "Departamento 2.2"
        ]);

        Maquinario::create([
            'empresas_id' => 1,
            'departamentos_id' => 1,
            'nome' => "Maquinário 1.1.1"
        ]);

        Maquinario::create([
            'empresas_id' => 1,
            'departamentos_id' => 2,
            'nome' => "Maquinário 1.2.2"
        ]);

        Maquinario::create([
            'empresas_id' => 1,
            'departamentos_id' => 1,
            'nome' => "Maquinário 1.1.3"
        ]);

        Maquinario::create([
            'empresas_id' => 1,
            'departamentos_id' => 2,
            'nome' => "Maquinário 1.2.4"
        ]);

        Maquinario::create([
            'empresas_id' => 2,
            'departamentos_id' => 3,
            'nome' => "Maquinário 2.3.5"
        ]);

        Peca::create([
            'empresas_id' => 1,
            'departamentos_id' => 1,
            'maquinarios_id' => 1,
            'nome' => "Peça 1.1.1.1"
        ]);

        Peca::create([
            'empresas_id' => 1,
            'departamentos_id' => 1,
            'maquinarios_id' => 2,
            'nome' => "Peça 1.1.2.1"
        ]);

        Peca::create([
            'empresas_id' => 2,
            'departamentos_id' => 3,
            'maquinarios_id' => 5,
            'nome' => "Peça 2.3.5.2"
        ]);

    }
}
