<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    public static function getFields(): array
    {
        return [
            Field::item(name: 'name', label:'Nome', show: true),
            Field::item(name: 'guard_name', label:'Contexto', type: 'select', values: [['web', 'Web']]),
        ];
    }
}
