<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Company;
use App\Models\Department;
use App\Models\Machinery;
use App\Models\Part;
use App\Models\Product;
use App\Models\ProductionOrder;
use App\Models\ProductionOrderAction;
use App\Models\ProductionOrderPart;
use App\Models\ProductionOrderProduct;
use App\Models\ProductRecipe;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $superAdmin = Role::create(['name' => 'super-admin']);
        $admin = Role::create(['name' => 'admin']);
        $colaborator = Role::create(['name' => 'colaborator']);

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

            $app_times, $app_budget, $app_selles, $app_ships, $app_courses
        ]);

        $admin->syncPermissions([
            $company_read,
            $department_create, $department_read, $department_update, $department_delete,
            $machinery_create, $machinery_read, $machinery_update, $machinery_delete,
            $part_create, $part_read, $part_update, $part_delete,
            $product_create, $product_read, $product_update, $product_delete,
            $production_order_create, $production_order_read, $production_order_update, $production_order_delete
        ]);

        $colaborator->syncPermissions([]);

        User::factory()->create(['name' => 'Carlos Barreto', 'username' => 'carlosbarretoeng', 'email' => 'carlosbarreto.eng@gmail.com', 'password' => Hash::make('C@rlos0303')])->assignRole('super-admin');

        Action::create(['name' => 'ORDER_CREATED_DRAFT', 'description' => 'Ordem criada em Rascunho']);
        Action::create(['name' => 'ORDER_PRODUCT_ADDED', 'description' => 'Produto adicionado à ordem']);

        // COMMENTAR DAQUI PRA BAIXO -----------------------------------------------------------------------------------


        Company::create(['name' => 'Agostini Tecnologia']);
        User::factory()->create(['company_id' => 1, 'name' => 'Administrator', 'username' => 'admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('C@rlos0303')])->assignRole('admin');
        User::factory()->create(['company_id' => 1, 'name' => 'Colaborator', 'username' => 'colab', 'email' => 'colab@gmail.com', 'password' => Hash::make('C@rlos0303')])->assignRole('colaborator');

        Department::create(['company_id' => 1, 'name' => 'Corte de Espuma']);
        Department::create(['company_id' => 1, 'name' => 'Corte de Tecido']);
        Department::create(['company_id' => 1, 'name' => 'Marcenaria']);
        Department::create(['company_id' => 1, 'name' => 'Costura']);
        Department::create(['company_id' => 1, 'name' => 'Montagem da Estrutura']);
        Department::create(['company_id' => 1, 'name' => 'Colocação de Percintas']);
        Department::create(['company_id' => 1, 'name' => 'Fixação da Espuma']);
        Department::create(['company_id' => 1, 'name' => 'Estofamento']);
        Department::create(['company_id' => 1, 'name' => 'Montagem']);
        Department::create(['company_id' => 1, 'name' => 'Embalagem']);
        Department::create(['company_id' => 1, 'name' => 'Expedição']);

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

        Product::create(['company_id' => 1, 'name' => 'Sofá de Testes']);

        Part::create(['company_id' => 1, 'name' => 'Pés de sofá padrão']);
        Part::create(['company_id' => 1, 'name' => 'Estrutura de braços esquerdo de sofá padrão']);
        Part::create(['company_id' => 1, 'name' => 'Estrutura de braços direito de sofá padrão']);
        Part::create(['company_id' => 1, 'name' => 'Estrutura de acentos de sofá padrão']);
        Part::create(['company_id' => 1, 'name' => 'Estrutura de encostos de sofá padrão']);
        Part::create(['company_id' => 1, 'name' => 'Espumas de braço esquerdo de sofá padrão']);
        Part::create(['company_id' => 1, 'name' => 'Espumas de braço direito de sofá padrão']);

        ProductRecipe::create(['product_id' => 1, 'part_id' => 1, 'order' => 1, 'quantity' => 4]);
        ProductRecipe::create(['product_id' => 1, 'part_id' => 2, 'order' => 2, 'quantity' => 1]);
        ProductRecipe::create(['product_id' => 1, 'part_id' => 3, 'order' => 3, 'quantity' => 1]);
        ProductRecipe::create(['product_id' => 1, 'part_id' => 4, 'order' => 4, 'quantity' => 2]);
        ProductRecipe::create(['product_id' => 1, 'part_id' => 5, 'order' => 5, 'quantity' => 2]);
        ProductRecipe::create(['product_id' => 1, 'part_id' => 6, 'order' => 6, 'quantity' => 1]);
        ProductRecipe::create(['product_id' => 1, 'part_id' => 7, 'order' => 7, 'quantity' => 1]);

        ProductionOrder::create([
            'company_id' => 1,
            'progress' => 0,
            'status' => 'draft',
            'date_start' => '2022-10-01',
            'date_finish' => '2022-10-01',
        ]);

        ProductionOrderAction::create([
            'production_order_id' => 1,
            'user_id' => 1,
            'action_id' => 1,
            'description' => 'AÇÃO TESTE'
        ]);

        ProductionOrderProduct::create(['production_order_id' => 1, 'product_id' => 1, 'quantity' => 5]);

        ProductionOrderPart::create([
            'production_order_id' => 1,
            'production_order_product_id' => 1,
            'product_recipe_id' => 1,
            'quantity' => 20,
            'done' => 0
        ]);
        ProductionOrderPart::create([
            'production_order_id' => 1,
            'production_order_product_id' => 1,
            'product_recipe_id' => 2,
            'quantity' => 5,
            'done' => 0
        ]);
        ProductionOrderPart::create([
            'production_order_id' => 1,
            'production_order_product_id' => 1,
            'product_recipe_id' => 3,
            'quantity' => 5,
            'done' => 0
        ]);
        ProductionOrderPart::create([
            'production_order_id' => 1,
            'production_order_product_id' => 1,
            'product_recipe_id' => 4,
            'quantity' => 10,
            'done' => 0
        ]);
        ProductionOrderPart::create([
            'production_order_id' => 1,
            'production_order_product_id' => 1,
            'product_recipe_id' => 5,
            'quantity' => 10,
            'done' => 0
        ]);
        ProductionOrderPart::create([
            'production_order_id' => 1,
            'production_order_product_id' => 1,
            'product_recipe_id' => 6,
            'quantity' => 5,
            'done' => 0
        ]);
        ProductionOrderPart::create([
            'production_order_id' => 1,
            'production_order_product_id' => 1,
            'product_recipe_id' => 7,
            'quantity' => 5,
            'done' => 0
        ]);

        ProductionOrderAction::create([
            'production_order_id' => 1,
            'user_id' => 1,
            'action_id' => 2,
            'description' => 'PRODUTO 1'
        ]);
    }
}
