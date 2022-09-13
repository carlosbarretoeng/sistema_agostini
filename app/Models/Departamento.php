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

    protected $with = ['empresas'];

    public function empresas()
    {
        return $this->belongsTo(Empresa::class);
    }

    public static function getDescription(): string
    {
        return 'nome';
    }

    public static function getFields(): array
    {
        return [
            Field::item(name: 'empresas_id', label:'Empresa', type: 'foreign', entity: Empresa::class),
            Field::item(name: 'nome', label:'Nome', show: true),
            Field::item(name: 'empresas.nome_fantasia', label:'Empresa', type: 'reference', show: true),
        ];
    }
}
