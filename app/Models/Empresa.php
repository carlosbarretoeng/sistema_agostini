<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'cnpj',
        'razao_social',
        'nome_fantasia',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf'
    ];

    public static function getDescription(): string
    {
        return 'nome_fantasia';
    }

    public static function getFields(): array
    {
        $unidadesFederativas = ["AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MG",
            "MS", "MT", "PA", "PB", "PE", "PI", "PR", "RJ", "RN", "RO", "RR", "RS", "SC", "SE", "SP", "TO"];
        return array(
            Field::item(name: 'cnpj', label: 'CNPJ', showInDesktop: true, mask: '##.###.###/####-##'),
            Field::item(name: 'nome_fantasia', label: 'Nome Fantasia', colSpan: 4, show: true),
            Field::item(name: 'razao_social', label:'Razão Social', colSpan: 5, show: true),
            Field::item(name: 'cep', label:'CEP', colSpan: 2, mask: '##.###-###'),
            Field::item(name: 'logradouro', label:'Logradouro', colSpan: 6),
            Field::item(name: 'numero', label:'Número', colSpan: 1),
            Field::item(name: 'complemento', label:'Complemento', colSpan: 3),
            Field::item(name: 'bairro', label:'Bairro', colSpan: 2),
            Field::item(name: 'cidade', label:'Cidade', colSpan: 2),
            Field::item(name: 'uf', label: 'UF', type: 'select', values: $unidadesFederativas, colSpan: 1),
        );
    }
}
