<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Times extends Model
{
    use HasFactory;

    const TYPE_PRODUCAO = 'Produção';
    const TYPE_ALMOCO = 'Almoço';
    const TYPE_CAFE = 'Café';
    const TYPE_LIMPEZA = 'Limpeza';
    const TYPE_REGULAGEM = 'Regulagem da máquina';
    const TYPE_INSUMOS = 'Busca de insumos, ferramentas, etc.';
    const TYPE_BANHEIRO = 'Banheiro';
}
