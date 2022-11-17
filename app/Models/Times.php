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

    public function scopeInCompany($query, $user)
    {
        if(!$user->hasRole('super-admin')){
            $userCompanyId = $user->company_id;
            return $query
                ->join('production_order_parts', 'production_order_part_id', '=', 'production_order_parts.id')
                ->join('production_orders', 'production_order_id', '=', 'production_orders.id')
                ->where('production_orders.company_id', $userCompanyId);
        }
        return $query;
    }
}
