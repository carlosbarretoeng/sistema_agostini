<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];

    public static function getFields(): array
    {
        return [
            Field::item(name: 'empresas_id', label:'Empresa', type: 'foreign', entity: Empresa::class),
            Field::item(name: 'nome', label:'Nome', show: true),
        ];
    }
}
