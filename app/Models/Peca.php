<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peca extends CrudModel
{
    use HasFactory;

    protected $with = ['empresas', 'departamentos', 'maquinarios'];

    public function empresas()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function departamentos()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function maquinarios()
    {
        return $this->belongsTo(Maquinario::class);
    }

    public static function getDescription(): string
    {
        return 'nome';
    }

    public static function getFields(): array
    {
        return [
            Field::item(name: 'empresas_id', label:'Empresa', type: 'foreign', entity: Empresa::class),
            Field::item(name: 'departamentos_id', label:'Departamento', type: 'foreign', entity: Departamento::class),
            Field::item(name: 'maquinarios_id', label:'Maquinário', type: 'foreign', entity: Maquinario::class),
            Field::item(name: 'nome', label: 'Nome', show: true),
            Field::item(name: 'empresas.nome_fantasia', label: 'Empresa', type: 'reference', show: true),
            Field::item(name: 'departamentos.nome', label: 'Departamento', type: 'reference', show: true),
        ];
    }
}
