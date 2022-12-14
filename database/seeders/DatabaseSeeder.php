<?php

namespace Database\Seeders;

use App\Http\Controllers\TimesPerPartController;
use App\Http\Controllers\TimesPerProductController;
use App\Models\Company;
use App\Models\Department;
use App\Models\Machinery;
use App\Models\Part;
use App\Models\PlanoDeConta;
use App\Models\Product;
use App\Models\ProductionOrder;
use App\Models\ProductionOrderPart;
use App\Models\ProductionOrderProduct;
use App\Models\ProductRecipe;
use App\Models\TimesPerPart;
use App\Models\TimesPerProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $superAdmin = Role::create(['name' => 'super-admin']);
        $admin = Role::create(['name' => 'admin']);
        $app_tempos = Role::create(['name' => 'app_tempos']);
        $app_custos = Role::create(['name' => 'app_custos']);

        $company_create = Permission::create(['name' => 'company.create']);
        $company_read = Permission::create(['name' => 'company.read']);
        $company_update = Permission::create(['name' => 'company.update']);
        $company_delete = Permission::create(['name' => 'company.delete']);

        $department_create = Permission::create(['name' => 'department.create']);
        $department_read = Permission::create(['name' => 'department.read']);
        $department_update = Permission::create(['name' => 'department.update']);
        $department_delete = Permission::create(['name' => 'department.delete']);

        $machinery_create = Permission::create(['name' => 'machinery.create']);
        $machinery_read = Permission::create(['name' => 'machinery.read']);
        $machinery_update = Permission::create(['name' => 'machinery.update']);
        $machinery_delete = Permission::create(['name' => 'machinery.delete']);

        $part_create = Permission::create(['name' => 'part.create']);
        $part_read = Permission::create(['name' => 'part.read']);
        $part_update = Permission::create(['name' => 'part.update']);
        $part_delete = Permission::create(['name' => 'part.delete']);

        $product_create = Permission::create(['name' => 'product.create']);
        $product_read = Permission::create(['name' => 'product.read']);
        $product_update = Permission::create(['name' => 'product.update']);
        $product_delete = Permission::create(['name' => 'product.delete']);

        $production_order_create = Permission::create(['name' => 'production_order.create']);
        $production_order_read = Permission::create(['name' => 'production_order.read']);
        $production_order_update = Permission::create(['name' => 'production_order.update']);
        $production_order_delete = Permission::create(['name' => 'production_order.delete']);

        $app_times = Permission::create(['name' => 'apps.times']);
        $app_budget = Permission::create(['name' => 'apps.budget']);
        $app_selles = Permission::create(['name' => 'apps.sales']);
        $app_ships = Permission::create(['name' => 'apps.ships']);
        $app_courses = Permission::create(['name' => 'apps.courses']);

        $superAdmin->syncPermissions([
            $company_create, $company_read, $company_update, $company_delete,
            $department_create, $department_read, $department_update, $department_delete,
            $machinery_create, $machinery_read, $machinery_update, $machinery_delete,
            $part_create, $part_read, $part_update, $part_delete,
            $product_create, $product_read, $product_update, $product_delete,
            $production_order_create, $production_order_read, $production_order_update, $production_order_delete,

            $app_times
        ]);

        $admin->syncPermissions([
            $company_read,
            $department_create, $department_read, $department_update, $department_delete,
            $machinery_create, $machinery_read, $machinery_update, $machinery_delete,
            $part_create, $part_read, $part_update, $part_delete,
            $product_create, $product_read, $product_update, $product_delete,
            $production_order_create, $production_order_read, $production_order_update, $production_order_delete,

            $app_times
        ]);

        $app_tempos->syncPermissions([
            $app_times
        ]);

        $app_custos->syncPermissions([
            $app_budget
        ]);

        User::factory()->create([
            'name' => 'Carlos Barreto',
            'username' => 'caju',
            'email' => 'carlosbarreto.eng@gmail.com',
            'password' => Hash::make('caju')
        ])->assignRole('super-admin');

        // COMMENTAR DAQUI PRA BAIXO -----------------------------------------------------------------------------------

        Company::create(['name' => 'Agostini Tecnologia']);

        User::factory()->create([
            'company_id' => 1,
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin')])->assignRole('admin');

        User::factory()->create([
            'company_id' => 1,
            'name' => 'App Tempos',
            'username' => 'tempos',
            'email' => 'tempos@tempos.com',
            'password' => Hash::make('tempos')])->assignRole('app_tempos');

        User::factory()->create([
            'company_id' => 1,
            'name' => 'App Custos',
            'username' => 'custos',
            'email' => 'custos@custos.com',
            'password' => Hash::make('custos')])->assignRole('app_custos');

        Department::create(['company_id' => 1, 'name' => 'Corte de Espuma']);
        Department::create(['company_id' => 1, 'name' => 'Corte de Tecido']);
        Department::create(['company_id' => 1, 'name' => 'Marcenaria']);
        Department::create(['company_id' => 1, 'name' => 'Costura']);
        Department::create(['company_id' => 1, 'name' => 'Montagem da Estrutura']);
        Department::create(['company_id' => 1, 'name' => 'Coloca????o de Percintas']);
        Department::create(['company_id' => 1, 'name' => 'Fixa????o da Espuma']);
        Department::create(['company_id' => 1, 'name' => 'Estofamento']);
        Department::create(['company_id' => 1, 'name' => 'Montagem']);
        Department::create(['company_id' => 1, 'name' => 'Embalagem']);
        Department::create(['company_id' => 1, 'name' => 'Expedi????o']);

        Machinery::create(['department_id' => 1, 'name' => 'Cortadora de Espuma 1']);
        Machinery::create(['department_id' => 2, 'name' => 'Cortadora de Tecido 1']);
        Machinery::create(['department_id' => 3, 'name' => 'Serra Fita 1']);
        Machinery::create(['department_id' => 3, 'name' => 'Serra Circular 1']);
        Machinery::create(['department_id' => 4, 'name' => 'Reta 1']);
        Machinery::create(['department_id' => 4, 'name' => 'Overlock 1']);
        Machinery::create(['department_id' => 4, 'name' => 'Galoneira']);
        Machinery::create(['department_id' => 5, 'name' => 'Grampeador 1']);
        Machinery::create(['department_id' => 5, 'name' => 'Parafusadeira 1']);
        Machinery::create(['department_id' => 6, 'name' => 'Grampeador 1']);
        Machinery::create(['department_id' => 6, 'name' => 'Parafusadeira 1']);
        Machinery::create(['department_id' => 7, 'name' => 'Coladeira 1']);

        Product::create(['company_id' => 1, 'name' => 'Sof?? de Testes']);
        Product::create(['company_id' => 1, 'name' => 'Poltrona de Testes']);

        Part::create(['company_id' => 1, 'machinery_id' => 1, 'name' => 'P??s padr??o']);
        Part::create(['company_id' => 1, 'machinery_id' => 2, 'name' => 'Estrutura de bra??os esquerdo de sof?? padr??o']);
        Part::create(['company_id' => 1, 'machinery_id' => 3, 'name' => 'Estrutura de bra??os direito de sof?? padr??o']);
        Part::create(['company_id' => 1, 'machinery_id' => 4, 'name' => 'Estrutura de acentos de sof?? padr??o']);
        Part::create(['company_id' => 1, 'machinery_id' => 5, 'name' => 'Estrutura de encostos de sof?? padr??o']);
        Part::create(['company_id' => 1, 'machinery_id' => 4, 'name' => 'Espumas de bra??o esquerdo de sof?? padr??o']);
        Part::create(['company_id' => 1, 'machinery_id' => 3, 'name' => 'Espumas de bra??o direito de sof?? padr??o']);

        Part::create(['company_id' => 1, 'machinery_id' => 2, 'name' => 'Estrutura de bra??os esquerdo de poltrona padr??o']);
        Part::create(['company_id' => 1, 'machinery_id' => 3, 'name' => 'Estrutura de bra??os direito de poltrona padr??o']);
        Part::create(['company_id' => 1, 'machinery_id' => 4, 'name' => 'Estrutura de acentos de poltrona padr??o']);
        Part::create(['company_id' => 1, 'machinery_id' => 5, 'name' => 'Estrutura de encostos de poltrona padr??o']);
        Part::create(['company_id' => 1, 'machinery_id' => 4, 'name' => 'Espumas de bra??o esquerdo de poltrona padr??o']);
        Part::create(['company_id' => 1, 'machinery_id' => 3, 'name' => 'Espumas de bra??o direito de poltrona padr??o']);

        ProductRecipe::create(['product_id' => 1, 'part_id' => 1, 'order' => 1, 'quantity' => 4]);
        ProductRecipe::create(['product_id' => 1, 'part_id' => 2, 'order' => 2, 'quantity' => 1]);
        ProductRecipe::create(['product_id' => 1, 'part_id' => 3, 'order' => 3, 'quantity' => 1]);
        ProductRecipe::create(['product_id' => 1, 'part_id' => 4, 'order' => 4, 'quantity' => 2]);
        ProductRecipe::create(['product_id' => 1, 'part_id' => 5, 'order' => 5, 'quantity' => 2]);
        ProductRecipe::create(['product_id' => 1, 'part_id' => 6, 'order' => 6, 'quantity' => 1]);
        ProductRecipe::create(['product_id' => 1, 'part_id' => 7, 'order' => 7, 'quantity' => 1]);

        ProductRecipe::create(['product_id' => 2, 'part_id' => 1, 'order' => 1, 'quantity' => 4]);
        ProductRecipe::create(['product_id' => 2, 'part_id' => 8, 'order' => 2, 'quantity' => 1]);
        ProductRecipe::create(['product_id' => 2, 'part_id' => 9, 'order' => 3, 'quantity' => 1]);
        ProductRecipe::create(['product_id' => 2, 'part_id' => 10, 'order' => 4, 'quantity' => 2]);
        ProductRecipe::create(['product_id' => 2, 'part_id' => 11, 'order' => 5, 'quantity' => 2]);
        ProductRecipe::create(['product_id' => 2, 'part_id' => 12, 'order' => 6, 'quantity' => 1]);
        ProductRecipe::create(['product_id' => 2, 'part_id' => 13, 'order' => 7, 'quantity' => 1]);

        (new \App\Actions\ProductionOrder\CreateNewProductionOrder())->create(
            1,
            Carbon::yesterday()->toDateTimeString(),
            Carbon::tomorrow()->toDateTimeString(),
            [
                [1, 150],
                [2, 50]
            ]
        );


        PlanoDeConta::create([
            'company_id' => 1,
            'identificador' => '1',
            'descricao' => 'Receitas',
            'tipo' => 'receita'
        ]);

        PlanoDeConta::create([
            'company_id' => 1,
            'superior' => 1,
            'identificador' => '1.1',
            'descricao' => 'Sal??rios',
            'tipo' => 'receita'
        ]);
        PlanoDeConta::create([
            'company_id' => 1,
            'superior' => 2,
            'identificador' => '1.1.1',
            'descricao' => 'AGOSTINI TECNOLOGIA',
            'tipo' => 'receita'
        ]);
        PlanoDeConta::create([
            'company_id' => 1,
            'superior' => 2,
            'identificador' => '1.1.2',
            'descricao' => 'AGOSTINI CONSULTORIA',
            'tipo' => 'receita'
        ]);

        PlanoDeConta::create([
            'company_id' => 1,
            'identificador' => '2',
            'descricao' => 'Despesas',
            'tipo' => 'despesa'
        ]);

        /**/
    }
}
