<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquinario extends Model
{
    use HasFactory;

    public static function getFields(): array
    {
        return [
            Field::item(name: 'empresas_id', label:'Empresa', type: 'foreign', entity: Empresa::class),
            Field::item(name: 'departamentos_id', label:'Departamento', type: 'foreign', entity: Departamento::class),
            Field::item(name: 'nome', label:'Nome', show: true),
        ];
    }
}
