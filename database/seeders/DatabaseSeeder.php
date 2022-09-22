<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Carlos Barreto',
            'email' => 'carlosbarreto.eng@gmail.com',
            'password' => Hash::make('C@rlos0303')
        ]);

        $companyCount = 0;
        $departmentCount = 0;
        $machineryCount = 0;

        for ($company = 0; $company < 2; $company++ ){
            $companyId = $company + 1;
            \App\Models\Company::create([
                'name' => 'Empresa de Teste ' . $companyId
            ]);
            $companyCount++;

            for ($department = 0; $department < 9; $department++ ){
                $departmentId = $department + 1;
                \App\Models\Department::create([
                    'company_id' => $companyCount,
                    'name' => 'Departamento ' . $companyId . '.' . $departmentId
                ]);
                $departmentCount++;

                for ($machinery = 0; $machinery < 2; $machinery++ ){
                    $machineryId = $machinery + 1;
                    \App\Models\Machinery::create([
                        'department_id' => $departmentCount,
                        'name' => 'Maquinário ' . $companyId . '.' . $departmentId . '.' . $machineryId
                    ]);
                    $machineryCount++;
                }
            }
        }
    }
}
