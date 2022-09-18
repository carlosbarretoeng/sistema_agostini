<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Company::create([
            'name' => 'Empresa de Teste 1'
        ]);

        \App\Models\Company::create([
            'name' => 'Empresa de Teste 2'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Carlos Barreto',
            'email' => 'carlosbarreto.eng@gmail.com',
            'password' => Hash::make('C@rlos0303')
        ]);
    }
}
